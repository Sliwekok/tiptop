<?php
/**
 * Created by PhpStorm.
 * User: Marek
 * Date: 30.04.2018
 * Time: 19:09
 */

namespace App\Http\Services;


use App\Animal;
use App\Exceptions\AccessDenied;
use App\Exceptions\AnimalNotFound;
use App\Helpers\Species;
use App\Helpers\Status;
use App\Photos;
use Carbon\Carbon;
use Debugbar;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class AnimalService
{

    /**
     * @var AppService
     */
    private $appService;

    /**
     * AnimalService constructor.
     * @param AppService $appService
     */
    public function __construct(AppService $appService)
    {
        $this->appService = $appService;
    }

    /**
     * Create animal record in database.
     *
     * TODO: Get is_active status from settings.
     *
     * @param $name string
     * @param $species
     * @param $status
     * @param $phone string
     * @param $placeName string
     * @param $lat float
     * @param $lng float
     * @param $accidentDate Carbon
     * @param $accidentTime Carbon
     * @param $description string
     * @param $idUser int
     * @param $notification string
     * @return int
     * @throws Exception
     */
    public function createAnimal($name, $species, $status, $phone, $placeName, $lat, $lng, $accidentDate, $accidentTime, $description, $idUser, $notification): int
    {

        try {

            if ($notification === null) {
                $notification = false;
            }

            $id = Animal::insertGetId([
                'name' => $name,
                'species' => $species,
                'status' => $status,
                'phone' => $phone,
                'place_name' => $placeName,
                'lat' => round($lat, 10),
                'lng' => round($lng, 10),
                'accident_date' => $accidentDate,
                'accident_time' => $accidentTime,
                'description' => $description,
                'is_finish' => false,
                'finish_status' => '',
                'finish_reason' => '',
                'notification' => $notification,
                'last_notification' => null,
                'is_active' => true,
                'id_user' => $idUser,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $this->appService->checkForAnimals($id);

        } catch (Exception $ex) {
            throw $ex;
        }

        return $id;

    }

    /**
     * Create animal record in database.
     *
     * TODO: Get is_active status from settings.
     *
     * @param $idAnimal int
     * @param $name string
     * @param $species
     * @param $status
     * @param $phone string
     * @param $placeName string
     * @param $lat float
     * @param $lng float
     * @param $accidentDate Carbon
     * @param $accidentTime Carbon
     * @param $description string
     * @param $notification string
     * @return bool
     * @throws Exception
     */
    public function updateAnimal($idAnimal, $name, $species, $status, $phone, $placeName, $lat, $lng, $accidentDate, $accidentTime, $description, $notification): bool
    {

        try {

            $animal = Animal::where('id', '=', $idAnimal);

            if (!$animal->exists()) {
                throw new AnimalNotFound();
            }

            $animal->update([
                'name' => $name,
                'species' => $species,
                'status' => $status,
                'phone' => $phone,
                'place_name' => $placeName,
                'lat' => round($lat, 10),
                'lng' => round($lng, 10),
                'accident_date' => $accidentDate,
                'accident_time' => $accidentTime,
                'description' => $description,
                'notification' => $notification,
                'updated_at' => Carbon::now()
            ]);

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $fileName string
     * @param $file UploadedFile
     * @param $status string
     * @param $species string
     * @param $idAnimal int
     * @param $name string
     */
    private function convertPhoto($fileName, $file, $status, $species, $idAnimal, $name)
    {

        $image = Image::make($file->getRealPath());

        $image->orientate();

        $imgWidth = $image->width();
        $imgHeight = $image->height();

        $targetWidth = 640;
        $targetHeight = 336;

        $vertical = (($imgWidth < $imgHeight) ? true : false);
        $horizontal = (($imgWidth > $imgHeight) ? true : false);
        $square = (($imgWidth = $imgHeight) ? true : false);

        if ($vertical) {

            $image->resize(null, $targetHeight, function ($constraint) {
                $constraint->aspectRatio();
            });

            if ($image->width() > $targetWidth) {
                $image->resize($targetWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

        } else if ($horizontal) {

            $image->resize($targetWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            if ($image->height() > $targetHeight) {
                $image->resize(null, $targetHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

        } else if ($square) {

            $image->resize($targetWidth, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            if ($image->height() > $targetHeight) {
                $image->resize(null, $targetHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

        }

        $image->resizeCanvas($targetWidth, 336, 'center', false, '#F2F2F2');

        $image->insert(public_path('images/animal-photo-mask.png'), 'bottom');

        $image->save(public_path('upload/animals/' . $fileName . '.jpg'));
    }

    /**
     * @param $idAnimal int
     * @param $file UploadedFile
     * @param $status string
     * @param $species string
     * @param $name string
     * @param $sortIndex int
     * @return bool
     * @throws Exception
     */
    public function createAnimalPhoto($idAnimal, $file, $status, $species, $name, $sortIndex): bool
    {

        try {

            $fileName = $idAnimal . '-' . $sortIndex . '-' . time();

            $this->convertPhoto($fileName, $file, $status, $species, $idAnimal, $name);

            Photos::insert([
                'file_name' => $fileName . '.jpg',
                'sort_index' => $sortIndex,
                'id_animal' => $idAnimal,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $idAnimal int
     * @param $idPhoto int|string
     * @param $file UploadedFile
     * @return bool
     * @throws Exception
     */
    public function changeAnimalPhoto($idAnimal, $idPhoto, $file): bool
    {

        try {

            $animal = Animal::where('id', '=', $idAnimal)->first();

            if (!$animal) {
                throw new AnimalNotFound();
            }

            if ($animal->id_user != Auth::user()->id) {
                throw new AccessDenied();
            }

            if ($idPhoto == 'none') {
                $this->createAnimalPhoto($idAnimal, $file, $animal->status, $animal->species, $animal->name, 0);
            } else {
                $oldPhotoName = Photos::where('id', '=', $idPhoto)->first()->file_name;

                unlink(public_path('upload/animals/' . $oldPhotoName));

                $fileName = $idAnimal . '-0-' . time();
                $this->convertPhoto($fileName, $file, $animal->status, $animal->species, $idAnimal, $animal->name);

                Photos::where('id', '=', $idPhoto)->update([
                    'file_name' => $fileName . '.jpg',
                    'updated_at' => Carbon::now()
                ]);
            }

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $idAnimal int
     * @param $reason string
     * @param $status string
     * @return bool
     * @throws Exception
     */
    public function finishAnimal($idAnimal, $reason, $status): bool
    {

        try {

            $animal = Animal::where('id', '=', $idAnimal);

            if (!$animal->exists()) {
                throw new AnimalNotFound();
            }

            $animal->update([
                'is_finish' => true,
                'finish_status' => $status,
                'finish_reason' => $reason,
                'updated_at' => Carbon::now()
            ]);

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }

    /**
     * @param $idAnimal
     * @return string
     * @throws Exception
     */
    public function getPhoneNumber($idAnimal): string
    {

        try {

            $animal = Animal::where('id', '=', $idAnimal)->first();

            if (!$animal) {
                throw new AnimalNotFound();
            }

        } catch (Exception $ex) {
            throw $ex;
        }

        return $animal->phone;
    }

    /**
     * @param $idAnimal
     * @return Animal
     * @throws Exception
     */
    public function getAnimal($idAnimal): Animal
    {

        try {

            $animal = Animal::where('id', '=', $idAnimal)->first();

            if (!$animal) {
                throw new AnimalNotFound();
            }

        } catch (Exception $ex) {
            throw $ex;
        }

        return $animal;
    }

    /**
     * @param $idAnimal
     * @return bool
     * @throws Exception
     */
    public function removeAnimal($idAnimal): bool
    {

        try {

            $animal = Animal::where('id', '=', $idAnimal)->first();

            if (!$animal) {
                throw new AnimalNotFound();
            }

            if ($animal->id_user != Auth::user()->id) {
                throw new AccessDenied();
            }

            DB::transaction(function () use ($idAnimal) {
                DB::table('user_animals_notifications')->where('id_animal', '=', $idAnimal)->delete();
                DB::table('photos')->where('id_animal', '=', $idAnimal)->delete();
                DB::table('animals')->delete($idAnimal);
            });

        } catch (Exception $ex) {
            throw $ex;
        }

        return true;

    }


}