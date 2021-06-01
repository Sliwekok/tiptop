<?php

use App\Http\Services\AnimalService;
use App\Http\Services\UserService;
use Illuminate\Database\Seeder;

class Animals extends Seeder
{
    /**
     * @var $animalService
     */
    private $animalService;

    private $userService;

    public function __construct(AnimalService $animalService, UserService $userService)
    {
        $this->animalService = $animalService;
        $this->userService = $userService;
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $speciesList = ['CAT', 'DOG', 'HAMSTER'];
        $statuses = ['LOST', 'FOUND'];

        for ($i = 0; $i <= 1000; $i++) {

            $userName = $faker->userName;
            $userEmail = 'user' . $i . '@sarz.pl';
            $userNotifications = rand(0, 1);

            $isUser = $this->userService->createUser($userName, $userEmail, "demo", $userNotifications);

            $status = $statuses[rand(0, 1)];
            $species = $speciesList[rand(0, 1)];

            if ($status === 'LOST') {
                $name = $faker->name();
            } else {
                $name = 'Nieznane';
            }

            $roundPhone = rand(0, 1);

            if ($roundPhone) {
                $phone = $faker->randomNumber(9, true);
            } else {
                $phone = '';
            }

            $placeName = "Swarzędz";
            $points = generate_random_point([52.4094651, 17.0488402], 10);

            $lat = $points[0];
            $lng = $points[1];

            $date = $faker->dateTimeBetween('-1 year', 'now');
            $accidentDate = $date;
            $accidentTime = $date;

            $description = $faker->realText(500);

            $notification = rand(0, 1);

            $this->animalService->createAnimal($name, $species, $status, $phone, $placeName, $lat, $lng, $accidentDate, $accidentTime, $description, $isUser, $notification);

        }

    }
}
