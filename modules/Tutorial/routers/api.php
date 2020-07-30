<?php
Route::group(
    [
        'middleware' => ['api', 'auth:api'],
        'namespace' => 'Tutorial\Http\Controllers\API',
        'prefix' => 'api/v1'
    ], function () {
    Route::resource('sections', 'SectionAPIController');
    Route::resource('lessons', 'LessonAPIController');
    Route::resource('tutorials', 'TutorialAPIController');

    Route::resource('file-lessons', 'FileLessonAPIController')->only([
        'update', 'destroy'
    ]);
});
