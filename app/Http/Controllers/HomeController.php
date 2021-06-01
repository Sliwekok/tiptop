<?php

namespace App\Http\Controllers;

use App\Http\Services\AppService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $appService;

    public function __construct(AppService $appService)
    {
        $this->appService = $appService;
    }

    public function welcome()
    {
        return view('home.welcome');
    }

    public function terms()
    {
        return view('home.terms');
    }

    public function privacyPolicy()
    {
        return view('home.privacy-policy');
    }

    public function collaboration()
    {
        return view('home.collaboration');
    }

    public function personalData()
    {
        return view('home.personal-data');
    }

    public function personalDataDetails()
    {
        return view('home.personal-data-details');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function lostAnimal()
    {
        return view('home.lost');
    }

    public function foundAnimal()
    {
        return view('home.found');
    }

    public function test()
    {
        $animals = $this->appService->checkForAnimals(1002);
        return response()->json($animals);
    }

}
