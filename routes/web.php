<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

include_once('admin.web.php');

Route::get('/', 'HomeController@welcome');
Route::get('/regulamin', 'HomeController@terms');
Route::get('/polityka-prywatnosci', 'HomeController@privacyPolicy');
Route::get('/dane-osobowe', 'HomeController@personalData');
Route::get('/przetwarzanie-danych-osobowych', 'HomeController@personalDataDetails');
Route::get('/wspolpraca', 'HomeController@collaboration');
Route::get('/kontakt', 'HomeController@contact');
Route::get('/zaginiony-zwierzak', 'HomeController@lostAnimal');
Route::get('/znaleziony-zwierzak', 'HomeController@foundAnimal');

Route::get('auth/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/wystapil-blad', 'AccountController@error');

//Route::get('/test', 'HomeController@test');
//
//Route::get('/mail', function () {
//    return view('emails.similar-animals');
//});

Route::get('/wyloguj', 'AccountController@logout');
Route::post('/login', 'AccountController@login');
Route::post('/create-user', 'AccountController@createAccount');
Route::post('/facebook-register', 'AccountController@facebookRegister');
Route::post('/resetuj-haslo', 'AccountController@resetPassword');
Route::get('/nowe-haslo/{token}', 'AccountController@resetPasswordView');
Route::post('/nowe-haslo', 'AccountController@setNewPassword');

Route::post('/numer-telefonu', 'AnimalController@getPhoneNumber');
Route::get('/zaginione-znalezione/{search?}', 'AnimalController@searchAnimals');

Route::middleware(['auth'])->prefix('konto')->group(function () {

    Route::get('/', 'AccountController@userAddedAnimals');
    Route::get('/ustawienia', 'AccountController@userAccountSettings');
    Route::get('/wiadomosci', 'AccountController@userAccountThreads');
    Route::get('/wiadomosci/{threadId}', 'AccountController@getThreadMessages');
    Route::post('/reply-message', 'AccountController@replyMessage');
    Route::post('/create-message', 'AccountController@createMessage');

    Route::post('/change-user-name', 'AccountController@changeUserName');
    Route::post('/change-user-email', 'AccountController@changeUserEmail');
    Route::post('/change-password', 'AccountController@changePassword');
    Route::post('/remove-account', 'AccountController@removeAccount');
    Route::post('/save-notifications-settings', 'AccountController@saveNotificationsSettings');

});

Route::prefix('ogloszenie')->group(function () {

    Route::get('/dodaj', 'AnimalController@animalForm')->middleware('auth');
    Route::post('/dodaj', 'AnimalController@createAnimal')->middleware('auth');

    Route::get('/edytuj/{id}', 'AnimalController@updateAnimalForm')->middleware('auth');
    Route::post('/edytuj', 'AnimalController@updateAnimal')->middleware('auth');
    Route::post('/zmien-zdjecie', 'AnimalController@changeAnimalPhoto')->middleware('auth');
    Route::post('/zakoncz', 'AnimalController@finishAnimal')->middleware('auth');
    Route::post('/usun', 'AnimalController@removeAnimal')->middleware('auth');

    Route::get('/szczegoly/{id}', 'AnimalController@animalDetails');

});