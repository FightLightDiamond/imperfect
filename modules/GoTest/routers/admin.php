<?php

Route::namespace('GoTest\Http\Controllers\Admin')
    ->middleware(['api', 'multiauth:admin'])
    ->prefix('api/v1/admin')
    ->group(function () {
        Route::resource('questions' , 'QuestionAdminController');
        Route::resource('question-tests' , 'QuestionTestAdminController');
        Route::resource('tests' , 'TestAdminController');
    });

