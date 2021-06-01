<?php

namespace App\Http\Services;


use App\Animal;
use App\Mail\SimilarAnimals;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AppService
{
    /**
     * Default search distance value.
     *
     * @var int $defaultDistance
     */
    private $defaultDistance = 50;

    /**
     * @param null $idAnimal
     * @return bool
     */
    public function checkForAnimals($idAnimal = null)
    {
        $animal = Animal::with(['user'])->where('id', '=', $idAnimal)->first();

        $status = 'LOST';

        if ($animal->status === 'LOST') {
            $status = 'FOUND';
        }

        if ($animal->notification && $animal->user->is_active && !$animal->user->is_disabled && $animal->user->notifications) {

            $animalsQuery = Animal::with(['photo'])
                ->select('id', 'name', 'place_name', 'status', 'species', 'accident_date', 'accident_time')
                ->addSelect(DB::raw("( 6371 * acos( cos( radians(" . $animal->lat . ") ) * cos( radians( animals.lat ) ) * cos( radians( animals.lng ) - radians(" . $animal->lng . ") ) + sin( radians(" . $animal->lat . ") ) * sin(radians(animals.lat)) ) ) as distance"))
                ->whereRaw("( 6371 * acos( cos( radians(" . $animal->lat . ") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(" . $animal->lng . ") ) + sin( radians(" . $animal->lat . ") ) * sin(radians(lat)) ) ) <= " . $this->defaultDistance)
                ->where('animals.id', '!=', $idAnimal)
                ->where('animals.is_finish', '=', false)
                ->where('animals.status', '=', $status)
                ->where('animals.species', '=', $animal->species)
                ->orderBy('animals.created_at', 'desc');

            if ($animalsQuery->count() > 0) {
                $animals = $animalsQuery->get();
                $status = animalStatus($animal->status);
                $species = animalSpecies($animal->species);
                // Mail::to($animal->user->email)->queue(new SimilarAnimals($animal->name, $status, $species, $animal->accident_date, $animal->accident_time, $animal->place_name, $animals));
            }

            Animal::where('id', '=', $idAnimal)->update(['last_notification' => Carbon::now()]);

        }

        return true;

    }

}
