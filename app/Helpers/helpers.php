<?php

use Carbon\Carbon;
//use Debugbar;

/**
 * @param $val string
 * @param $length int
 * @return string
 */
function pads($val, $length): string
{
    return str_pad((string)$val, $length, '0', STR_PAD_LEFT);
}

function isToday($date)
{
    $date = Carbon::parse($date)->format('Y-m-d');
    $today = Carbon::now()->format('Y-m-d');
    return $date === $today;
}

/**
 * @param $idAnimal int
 * @return string
 */
function createReferenceNumber($idAnimal): string
{
    return pads($idAnimal, 6);
}

/**
 * @param $status
 * @param bool $upper
 * @return mixed
 */
function animalStatus($status, $upper = false)
{

    $statuses = [
        'LOST' => 'Zaginiony',
        'FOUND' => 'Znaleziony'
    ];

    $statusResult = $statuses[$status];

    if ($upper) {
        $statusResult = strtoupper($statuses[$status]);
    }

    return $statusResult;

}

/**
 * @param $species
 * @return string
 */
function animalSpecies($species)
{

    $speciesList = [
        'CAT' => 'Kot',
        'DOG' => 'Pies',
        'HAMSTER' => 'Chomik'
    ];

    return $speciesList[$species];

}

/**
 * @param $name string
 * @return string
 */
function historyName($name)
{
    switch ($name) {
        case 'CHANGE_PASSWORD':
            $publicName = "Zmiana hasła";
            break;
        case 'CHANGE_USER_EMAIL':
            $publicName = "Zmiana adresu email";
            break;
        case 'CHANGE_USER_NAME':
            $publicName = "Zmiana nazwy użytkownika";
            break;
        case 'TERMS':
            $publicName = "Regulamin";
            break;
        case 'PRIVACY_POLICY':
            $publicName = "Polityka prywatności";
            break;
        case 'MESSAGES_NOTIFICATION':
            $publicName = "Powiadomienia";
            break;
        default:
            $publicName = "";
            break;
    }

    return $publicName;

}

function parseHistoryValue($name, $value)
{

    switch ($name) {
        case 'CHANGE_PASSWORD':
            $publicValue = "Hasło do konta sarz.pl zostało zmienione.";
            break;
        case 'CHANGE_USER_EMAIL':
            $pv = json_decode($value);
            $publicValue = "Zmieniono adres email z " . $pv->oldEmail . ' na ' . $pv->newEmail . '.';
            break;
        case 'CHANGE_USER_NAME':
            $pv = json_decode($value);
            $publicValue = "Zmieniono nazwę użytkownika z " . $pv->oldName . ' na ' . $pv->newName . '.';
            break;
        case 'TERMS':
            $publicValue = "Akceptacja regulaminu z dnia " . $value . ".";
            break;
        case 'PRIVACY_POLICY':
            $publicValue = "Akceptacja polityki prywatności z dnia " . $value . ".";
            break;
        case 'MESSAGES_NOTIFICATION':
            $publicValue = "Akceptacja powiadomień o nowych wiadomościach w serwisie Sarz.pl.";
            break;
        default:
            $publicValue = "";
            break;
    }

    return $publicValue;
}

/**
 * @param $status
 * @return string
 */
function animal_status($status)
{

    switch ($status) {
        case 'found-home':
            $publicValue = "Odnaleziono właściciela";
            break;
        case 'found-animal':
            $publicValue = "Odnaleziono zwierzę";
            break;
        case 'shelter':
            $publicValue = "Trafiło do schroniska";
            break;
        case 'dead':
            $publicValue = "Znaleziono martwe";
            break;
        case 'other':
            $publicValue = "Status zakończenia określono jako inne";
            break;
        default:
            $publicValue = "";
            break;
    }

    return $publicValue;
}

function generate_random_point($centre, $radius)
{

    $radius_earth = 6371; //miles

    //Pick random distance within $distance;
    $distance = lcg_value() * $radius;

    //Convert degrees to radians.
    $centre_rads = array_map('deg2rad', $centre);

    //First suppose our point is the north pole.
    //Find a random point $distance miles away
    $lat_rads = (pi() / 2) - $distance / $radius_earth;
    $lng_rads = lcg_value() * 2 * pi();


    //($lat_rads,$lng_rads) is a point on the circle which is
    //$distance miles from the north pole. Convert to Cartesian
    $x1 = cos($lat_rads) * sin($lng_rads);
    $y1 = cos($lat_rads) * cos($lng_rads);
    $z1 = sin($lat_rads);


    //Rotate that sphere so that the north pole is now at $centre.

    //Rotate in x axis by $rot = (pi()/2) - $centre_rads[0];
    $rot = (pi() / 2) - $centre_rads[0];
    $x2 = $x1;
    $y2 = $y1 * cos($rot) + $z1 * sin($rot);
    $z2 = -$y1 * sin($rot) + $z1 * cos($rot);

    //Rotate in z axis by $rot = $centre_rads[1]
    $rot = $centre_rads[1];
    $x3 = $x2 * cos($rot) + $y2 * sin($rot);
    $y3 = -$x2 * sin($rot) + $y2 * cos($rot);
    $z3 = $z2;


    //Finally convert this point to polar co-ords
    $lng_rads = atan2($x3, $y3);
    $lat_rads = asin($z3);

    return array_map('rad2deg', array($lat_rads, $lng_rads));
}