<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Exceptions\AnimalNotFound;
use App\Exceptions\PageNotExistsException;
use App\Http\Services\AnimalService;
use App\Mail\AccountCreated;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AnimalController extends Controller
{

    /**
     * @var AnimalService
     */
    private $animalService;

    public function __construct(AnimalService $animalService)
    {
        $this->animalService = $animalService;
    }

    public function animalForm()
    {
        return view('animal.add-animal');
    }

    public function updateAnimalForm($id)
    {

        try {

            $animal = Animal::where('id', '=', $id)->where('is_finish', '=', false)->where('id_user', '=', Auth::user()->id)->with(['photo'])->first();

            if (!$animal) {
                throw new AnimalNotFound();
            }

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return view('animal.update-animal', ['animal' => $animal]);

    }

    public function animalDetails($id)
    {

        try {

            if (!is_numeric($id)) {
                throw new PageNotExistsException();
            }

            $animal = Animal::where('id', '=', $id)->with(['photo'])->first();

            if (!$animal) {
                throw new AnimalNotFound();
            }

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return view('animal.details-animal', ['animal' => $animal]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAnimal(Request $request)
    {

        try {

            $idAnimal = $this->animalService->createAnimal(
                $request->get('name'),
                $request->get('species'),
                $request->get('status'),
                $request->get('phone'),
                $request->get('placeName'),
                $request->get('lat'),
                $request->get('lng'),
                $request->get('accidentDate'),
                $request->get('accidentTime'),
                $request->get('description'),
                Auth::user()->id,
                $request->get('notification')
            );

            $this->animalService->createAnimalPhoto(
                $idAnimal,
                $request->file('photo'),
                $request->get('status'),
                $request->get('species'),
                $request->get('name'),
                0
            );

            toast()->success('Ogłoszenie zostało utworzone i opublikowane.');

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('ogloszenie/szczegoly/' . $idAnimal);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeAnimalPhoto(Request $request)
    {

        try {

            $this->animalService->changeAnimalPhoto(
                $request->get('idAnimal'),
                $request->get('idPhoto'),
                $request->file('photo')
            );

            toast()->success('Zdjęcie zostało zmienione.');

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('konto');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAnimal(Request $request)
    {

        try {

            $this->animalService->updateAnimal(
                $request->get('idAnimal'),
                $request->get('name'),
                $request->get('species'),
                $request->get('status'),
                $request->get('phone'),
                $request->get('placeName'),
                $request->get('lat'),
                $request->get('lng'),
                $request->get('accidentDate'),
                $request->get('accidentTime'),
                $request->get('description'),
                $request->get('notification')
            );

            toast()->success('Dane w ogłoszeniu zostały zaktualizowane.');

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('konto');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finishAnimal(Request $request)
    {

        try {

            $this->animalService->finishAnimal(
                $request->get('idAnimal'),
                $request->get('reason'),
                $request->get('status')
            );

            toast()->success('Ogłoszenie zostało zakończone.');

        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('konto');

    }

    /**
     * @param string $search
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchAnimals($search = null)
    {

        $request = [
            'status' => 'ALL',
            'species' => 'ALL',
            'lat' => '',
            'lng' => '',
            'place' => '',
            'distance' => '5',
            'words' => ''
        ];

        if ($search) {
            $decoded = json_decode(base64_decode($search), true);
            $request = array_merge($request, $decoded);
        }

        $animalsQuery = Animal::with(['photo'])->select('id', 'name', 'place_name', 'status', 'species', 'updated_at', 'description', 'accident_date', 'accident_time')->where('animals.is_finish', '=', false);

        if ($request['status'] != 'ALL') {
            $animalsQuery->where('animals.status', '=', $request['status']);
        }

        if ($request['species'] != 'ALL') {
            $animalsQuery->where('animals.species', '=', $request['species']);
        }

        if ($request['words'] != '') {

            $string = preg_replace('/\,/', ' ', $request['words']);
            $string = preg_replace('/\s+/', ' ', $string);
            $keywordsArray = explode(" ", $string);

            foreach ($keywordsArray as $key => $keyword) {
                if ($key == 0) {
                    $animalsQuery->whereRaw('lower(animals.description) LIKE \'%' . strtolower($keyword) . '%\'');
                } else {
                    $animalsQuery->orWhereRaw('lower(animals.description) LIKE \'%' . strtolower($keyword) . '%\'');
                }
            }

        }

        if ($request['place'] != '' && $request['lat'] != '' && $request['lng'] != '') {
            $animalsQuery->addSelect(DB::raw("( 6371 * acos( cos( radians(" . $request['lat'] . ") ) * cos( radians( animals.lat ) ) * cos( radians( animals.lng ) - radians(" . $request['lng'] . ") ) + sin( radians(" . $request['lat'] . ") ) * sin(radians(animals.lat)) ) ) as distance"));
            $animalsQuery->whereRaw("( 6371 * acos( cos( radians(" . $request['lat'] . ") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(" . $request['lng'] . ") ) + sin( radians(" . $request['lat'] . ") ) * sin(radians(lat)) ) ) <= " . $request['distance']);
        }

        $animals = $animalsQuery->orderBy('animals.created_at', 'desc')->paginate(21);

        return view('animals', ['animals' => $animals, 'request' => $request]);

    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function getPhoneNumber(Request $request)
    {
        return response()->json($this->animalService->getPhoneNumber($request->get('id')));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAnimal(Request $request)
    {

        try {
            $this->animalService->removeAnimal($request->get('id'));
            toast()->success("Ogłoszenie zostało usunięte.");
        } catch (Exception $ex) {
            return redirect()->to('/wystapil-blad')->with('exception', $ex->getMessage());
        }

        return redirect()->to('konto');

    }

}
