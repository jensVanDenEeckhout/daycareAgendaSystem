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

Route::get('/', function () {
    return view('welcome');
});

	Route::get('/2/aanwezig/personeel', 'PagesController@personeelAanwezig');
	Route::post('/2/attendanceListChangeStatusSelectedEmployee', 'PagesController@attendanceListChangeStatusSelectedEmployee');

//unknown
	Route::post('/tasks2/saveTasks', 'PagesController@saveTasks');


// new
	// overview of all the inhabitants of the institution
	Route::get('/2/overzicht/bewoners', 'PagesController@overzichtBewoners');

	// after making a selection of all the desired inhabitants you will see their daily tasks based on the selected day
	Route::post('/2/overzicht/dagplanning', 'PagesController@overzichtDagplanning');
	// click task, will mark it as done
	Route::post('/2/overzicht/taken/taak/compleet', 'PagesController@taakCompleet');

	// ability to change the tasks of the selected inhabitants
	Route::post('/2/bewerken/dagplanning', 'PagesController@bewerkenDagplanning');
	Route::post('/2/bewerken/taken/aanpassen/taak', 'PagesController@aanpassenTaak');
	Route::post('/2/bewerken/taken/aanpassen/verantwoordelijkeOrganisatie
	', 'PagesController@aanpassenVerantwoordelijkeOrganisatie');




Route::post('/2/toevoegen','PagesController@toevoegen');

Route::post('/2/toevoegen/taak', 'PagesController@toevoegenTaak');
Route::post('/2/verwijderen/taak', 'PagesController@verwijderenTaak');


Route::post('/2/toevoegen/personeel', 'PagesController@toevoegenPersoneel');
Route::post('/2/verwijderen/personeel', 'PagesController@verwijderenPersoneel');


Route::post('/2/aanwezigheidslijst', 'PagesController@aanwezigheidslijst');

Route::post('/2/notities', 'PagesController@notities');


	//testing

		Route::post('/tasks/post', 'PagesController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// tijdsregistratie
Route::post('/2/tijdsregistratie/overzicht','TijdsRegistratieController@tijdsregistratie_overzicht');


Route::post('/2/startTime/now/start','PagesController@startTimeStart');

Route::post('/2/timetracker/stop','PagesController@timetracker_stop');

Route::post('/2/timetracker/seperatePerDate','TijdsRegistratieController@timetracker_seperatePerDate');

