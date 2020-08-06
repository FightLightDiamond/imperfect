<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

const SORT_FILTER = 'sort';
const MY_FILTER = 'my';
const RANDOM_ORDER_FILTER = '{randomOrder}';
const RELATIONSHIP_FILTER = '{relationship}';


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
