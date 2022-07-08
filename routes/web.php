<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LiveSearch;
use App\Http\Controllers\TaskController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes(['register'=>false]);


Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

    Route::get('/', 'HomeControllerr@index');

    // Route::get('/', 'HomeController@index')->name('home.index');

    // Route::group(['middleware' => ['guest']], function() {
    
    // });

    Route::group(['middleware' => ['auth', 'permission']], function() {
       
        Route::group(['prefix' => 'posts'], function() {
            Route::get('/', 'PostsController@index')->name('posts.index');
            Route::get('/create', 'PostsController@create')->name('posts.create');
            Route::post('/create', 'PostsController@store')->name('posts.store');
            Route::get('/{post}/show', 'PostsController@show')->name('posts.show');
            Route::get('/{post}/edit', 'PostsController@edit')->name('posts.edit');
            Route::patch('/{post}/update', 'PostsController@update')->name('posts.update');
            Route::delete('/{post}/delete', 'PostsController@destroy')->name('posts.destroy');
        });

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });
});




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
], function () {
   
        
    Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('admin.dashboard');
    });

});




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
], function () {

    Route::group(['namespace' => 'App\Http\Controllers\Dashboard', 'prefix' => 'admin'], function () {

    

           Route::get('city/restore/one/{id}', 'CityController@restore')->name('city.restore');
           Route::get('city/restoreAll', 'CityController@restoreAll')->name('city.restore.all');
           Route::get('/task/destroy/{id}','CityController@damage')->name('city.damage');


           Route::get('car/restore/one/{id}', 'CarController@restore')->name('car.restore');
           Route::get('car/restoreAll', 'CarController@restoreAll')->name('car.restore.all');
           Route::get('/task/destroy/{id}','caraController@damage')->name('car.damage');



           Route::get('carmodel/restore/one/{id}', 'CarModelController@restore')->name('carmodel.restore');
           Route::get('carmodel/restoreAll', 'CarModelController@restoreAll')->name('carmodel.restore.all');
           Route::get('/task/destroy/{id}','CarmodelController@damage')->name('carmodel.damage');


           Route::get('codriver/restore/one/{id}', 'CodriverController@restore')->name('codriver.restore');
           Route::get('codriver/restoreAll', 'CodriverController@restoreAll')->name('codriver.restore.all');
           Route::get('/task/destroy/{id}','CodriverController@damage')->name('codriver.damage');


           Route::get('company/restore/one/{id}', 'CompanyController@restore')->name('company.restore');
           Route::get('company/restoreAll', 'CompanyContoller@restoreAll')->name('comapny.restore.all');
           Route::get('/task/destroy/{id}','CompanyController@damage')->name('company.damage');


           Route::get('drivers/restore/one/{id}', 'DriversController@restore')->name('drivers.restore');
           Route::get('drivers/restoreAll', 'DriversController@restoreAll')->name('drivers.restore.all');
           Route::get('/task/destroy/{id}','DriversController@damage')->name('drivers.damage');


           Route::get('users/restore/one/{id}', 'UsersController@restore')->name('users.restore');
           Route::get('users/restoreAll', 'UsersController@restoreAll')->name('users.restore.all');
           Route::get('/task/destroy/{id}','UsersController@damage')->name('users.damage');


           Route::get('trip/restore/one/{id}', 'TripController@restore')->name('trip.restore');
           Route::get('trip/restoreAll', 'TripController@restoreAll')->name('trip.restore.all');
           Route::get('/task/destroy/{id}','TripController@damage')->name('trip.damage');

        //    Route::get('/datesearch', 'TripController@searchindex')->name('page.report');
           Route::get('/report', 'TripController@daily_report')->name('report');









###########################################################################################################
###########################################################################################################
###########################################################################################################












           
        Route::group(['prefix' => 'city'], function () {
            Route::get('/','CityController@index') -> name('admin.city');
            Route::get('create','CityController@create') -> name('admin.city.create');
            Route::post('store','CityController@store') -> name('admin.city.store');
            Route::get('edit/{id}','CityController@edit') -> name('admin.city.edit');
            Route::post('update/{id}','CityController@update') -> name('admin.city.update');
            Route::get('delete/{id}','CityController@destroy') -> name('admin.city.delete');
         });

         ################################## carmodels routes ######################################
        Route::group(['prefix' => 'carmodel'], function () {
            Route::get('/','CarModelController@index') -> name('admin.carmodel');
            Route::get('create','CarModelController@create') -> name('admin.carmodel.create');
            Route::post('store','CarModelController@store') -> name('admin.carmodel.store');
            Route::get('edit/{id}','CarModelController@edit') -> name('admin.carmodel.edit');
            Route::post('update/{id}','CarModelController@update') -> name('admin.carmodel.update');
            Route::get('delete/{id}','CarModelController@destroy') -> name('admin.carmodel.delete');
        });

        ################################## end categories    #######################################

        ################################## users routes ######################################
        Route::group(['prefix' => 'users'], function () {
            Route::get('/','UsersController@index') -> name('admin.users');
            Route::get('create','UsersController@create') -> name('admin.users.create');
            Route::post('store','UsersController@store') -> name('admin.users.store');
            Route::get('/{user}/edit','UsersController@edit') -> name('admin.users.edit');
            Route::post('update/{id}','UsersController@update') -> name('admin.users.update');
            Route::get('delete/{id}','UsersController@destroy') -> name('admin.users.delete');
        });

        ################################## end categories    #######################################

        ################################## cars routes ######################################
        Route::group(['prefix' => 'Cars'], function () {
            Route::get('/','CarController@index') -> name('admin.cars');
            Route::get('create','CarController@create') -> name('admin.cars.create');
            Route::post('store','CarController@store') -> name('admin.cars.store');
            Route::get('edit/{id}','CarController@edit') -> name('admin.cars.edit');
            Route::post('update/{id}','CarController@update') -> name('admin.cars.update');
            Route::get('delete/{id}','CarController@destroy') -> name('admin.cars.delete');
        });
        ################################## end brands    #######################################
       
        ################################## drivers routes ######################################
        Route::group(['prefix' => 'drivers'], function () {
            Route::get('/','DriversController@index') -> name('admin.drivers');
            Route::get('create','DriversController@create') -> name('admin.drivers.create');
            Route::post('store','DriversController@store') -> name('admin.drivers.store');
            Route::get('edit/{id}','DriversController@edit') -> name('admin.drivers.edit');
            Route::post('update/{id}','DriversController@update') -> name('admin.drivers.update');
            Route::get('delete/{id}','DriversController@destroy') -> name('admin.drivers.delete');
           



        });
        ################################## end brands    #######################################

        ################################## trips routes ######################################
        Route::group(['prefix' => 'trip'], function () {
            Route::get('/','TripController@index') -> name('admin.trip');
            Route::get('create','TripController@create') -> name('admin.trip.create');
            Route::post('store','TripController@store') -> name('admin.trip.store');
             Route::get('delete/{id}','TripController@destroy') -> name('admin.trip.delete');
            Route::get('edit/{id}','TripController@edit') -> name('admin.trip.edit');
            Route::post('update/{id}','TripController@update') -> name('admin.trip.update');
        });
        ################################## end brands    #######################################

        ################################## codriver routes ######################################
        Route::group(['prefix' => 'codriver'], function () {
            Route::get('/','CodriverController@index') -> name('admin.codriver');
            Route::get('create','CodriverController@create') -> name('admin.codriver.create');
            Route::post('store','CodriverController@store') -> name('admin.codriver.store');
             Route::get('delete/{id}','CodriverController@destroy') -> name('admin.codriver.delete');
            Route::get('edit/{id}','CodriverController@edit') -> name('admin.codriver.edit');
            Route::post('update/{id}','CodriverController@update') -> name('admin.codriver.update');
        });
        ################################## end attributes    #######################################

        ################################## companies ######################################
        Route::group(['prefix' => 'companies'], function () {
            Route::get('/','CompanyController@index') -> name('admin.company');
            Route::get('create','CompanyController@create') -> name('admin.company.create');
            Route::post('store','CompanyController@store') -> name('admin.company.store');
            Route::get('delete/{id}','CompanyController@destroy') -> name('admin.company.delete');
            Route::get('edit/{id}','CompanyController@edit') -> name('admin.company.edit');
            Route::post('update/{id}','CompanyController@update') -> name('admin.company.update');
        });
        ################################## end options    #######################################



    });

   
        
});




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
], function () {


    // Route::get('/live_search',[App\Http\Controllers\LiveSearch::class, 'index'])->name('live_search');
    Route::get('/live_search/action', [App\Http\Controllers\LiveSearch::class, 'action'])->name('live_search.action');





    Route::group(['namespace' => 'App\Http\Controllers'], function()
    {   
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
        
    });
    Route::group(['namespace' => 'App\Http\Controllers','prefix' => 'admin'], function () {
        // Route::get('/live_search','LiveSearchdriver@index')->name('search.drivers');
        // Route::get('/live_search/action',)->name('live_search.action');
     
           Route::get('/driver/search', 'LiveSearchdriver@search')->name('search.driver.action');
           Route::get('/user/search', 'UserLiveSearch@search')->name('search.users');
           Route::get('/trip/search', 'TripLiveSearch@search')->name('search.trips');
           Route::get('/city/search', 'CityLiveSearch@search')->name('search.cities');
           Route::get('/codriver/search', 'CodriverLiveSearch@search')->name('search.codrivers');
           Route::get('/company/search', 'CompanyLiveSearch@search')->name('search.companies');
           Route::get('/carmodel/search', 'CarmodelLiveSearch@search')->name('search.carmodels');
           Route::get('/car/search', 'CarLiveSearch@search')->name('search.car');

           
      

    
        });
        
});