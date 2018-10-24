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
Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('patient', 'PatientController');
    Route::resource('appointment', 'AppointmentController');
    Route::resource('medication', 'MedicationController');
    Route::resource('diagnose', 'DiagnoseController');
    Route::resource('complaint', 'ComplaintController');
    Route::resource('visit', 'VisitController');
    Route::get('/setting', 'HomeController@setting')->name('setting');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::match(['put', 'patch'], '/setting/update/{id}','HomeController@update');
    Route::get('/search','PatientController@search');
    Route::get('/search/{id}','PatientController@searchbyid');
    Route::get('/chosensearch/{id}','VisitController@searchbyid');
});
Auth::routes();


Route::post('/language-chooser','LanguageController@changeLanguage');
Route::post('/language',array(
   'before' => 'csrf',
    'as' => 'language-chooser',
    'uses' => 'LanguageController@changeLanguage'
));
//Route::post('/language');
//Route::post('/language', 'HomeController@index')->name('home');
Route::group(['middleware' => ['web']], function () {
	Route::resource('posts', 'PostsController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('todo', 'TodoController');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alpha', function () {
    return view('alpha');
});


Route::get('addmoney/stripe', array('as' => 'addmoney.paywithstripe','uses' => 'AddMoneyController@payWithStripe'));
Route::post('addmoney/stripe', array('as' => 'addmoney.stripe','uses' => 'AddMoneyController@postPaymentWithStripe'));

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');


Route::resource('/cruds', 'CrudsController', [
    'except' => ['edit', 'show', 'store']
]);