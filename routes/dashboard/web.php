<?php
//Route::get('datatest', 'CustomerController@ajax')->name('datatest');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', 'WelcomeController@index')->name('welcome');


            //user routes
            Route::resource('users', 'UserController')->except(['show']);
            Route::post('users/block/{id}', 'UserController@block')->name('users.block');

            Route::resource('roles', 'RoleController')->except(['show']);


            //countries
            //cities
            //customers


            //venues


            Route::resource('locations', 'LocationController');

            Route::resource('pages', 'PageController');


            Route::resource('contact_us', 'ContactController');

            Route::resource('settings', 'SettingController');

            Route::resource('companies', 'CompanyController');

            Route::resource('services', 'ServiceController');


            Route::get('Maincompany', 'CompanyController@Maincompany')->name('Maincompany');


            Route::resource('sliders', 'SliderController');
//            Route::get('settings', 'SettingController@index')->name('settings');


            Route::post('settings', 'SettingController@updateAll')->name('settings.updateAll');

            Route::get('logout', 'UserController@logout')->name('logout');

            Route::get('soicallogin', function () {
                return view('firebase');

            });


            Route::get('logouts', function () {
                auth()->logout();
//                Session::forget('uid');
                return redirect('/');
//                firebase.auth().signOut();
            })->name('logouts');


        });//end of dashboard routes
    });





