<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SimilarAnimals extends Mailable
{
    use Queueable, SerializesModels;

    private $status;
    private $species;
    private $animals;
    private $accidentDate;
    private $accidentTime;
    private $placeName;
    private $animalName;

    /**
     * SimilarAnimals constructor.
     * @param $animalName
     * @param $status
     * @param $species
     * @param $accidentDate
     * @param $accidentTime
     * @param $placeName
     * @param $animals
     */
    public function __construct($animalName, $status, $species, $accidentDate, $accidentTime, $placeName, $animals)
    {
        $this->status = $status;
        $this->species = $species;
        $this->animals = $animals;
        $this->accidentTime = $accidentTime;
        $this->accidentDate = $accidentDate;
        $this->placeName = $placeName;
        $this->animalName = $animalName;
        $this->subject($animalName . " - Pasujące ogłoszenia");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.similar-animals')->with([
            'animalName' => $this->animalName,
            'animals' => $this->animals,
            'status' => $this->status,
            'species' => $this->species,
            'placeName' => $this->placeName,
            'accidentTime' => $this->accidentTime,
            'accidentDate' => $this->accidentDate
        ]);
    }
}
