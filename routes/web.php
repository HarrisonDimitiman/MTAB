<?php

Auth::routes();

Route::redirect('/','/login');

Route::group(['middleware' => ['auth']],function() { 

    Route::get('/dashboard','DashboardController@index')->name('dashboard.index');
      
    Route::group(['middleware' => ['role:admin']],function() { 

        Route::group(['middleware' => ['role:admin']],function() { 

            Route::get('/judRestore/{id}', 'JudgesController@restore')->name('jud.restore');
            Route::get('/crtRestore/{id}/{programs_id}', 'CriteriaController@restore')->name('crt.restore');
            Route::post('/destroyCrt/{crt_id}/{programs_id}/{event_id}', 'CriteriaController@destroy');
            Route::post('/crt/update/{crt_id}', 'CriteriaController@update');
            Route::get('/crtEdit/{crt_id}', 'CriteriaController@edit');
            Route::post('/addCriteria', 'CriteriaController@addCriteria');
            Route::get('/viewCrits/{event_id}/{programs_id}', 'CriteriaController@index');
            Route::get('/eventRestore/{id}/{programs_id}', 'EventController@restore')->name('event.restore');
            Route::post('/destroyEvent/{events_id}/{programs_id}', 'EventController@destroy');
            Route::post('/event/update/{events_id}', 'EventController@update');
            Route::get('/eventEdit/{events_id}', 'EventController@edit');
            Route::get('/event/{prgrm_id}/', 'EventController@index');
            Route::get('program/{id}/', 'ProgramController@restore')->name('program.restore');

            Route::resource('users','UsersController');     
            Route::resource('program','ProgramController');   
            Route::resource('event','EventController');  
            Route::resource('judges','JudgesController');         
        });
    });    
});