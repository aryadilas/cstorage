<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\SheetController;
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
//     return view('index');
// });
Route::get('/', [FolderController::class, 'index']);
Route::post('/', [FolderController::class, 'store']);
Route::delete('/{folderId}', [FolderController::class, 'delete']);

Route::get('/cheat/{folderId}', [SheetController::class, 'show']);
Route::post('/cheat/{folderId}', [SheetController::class, 'store']);
Route::delete('/cheat/{folderId}', [SheetController::class, 'delete']);

Route::put('/sheet/{sheetId}', [SheetController::class, 'update']);
Route::get('/sheet/{sheetId}', [SheetController::class, 'getData']);
