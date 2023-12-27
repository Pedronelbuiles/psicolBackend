<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/register', [AuthController::class, 'create']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('students', StudentController::class);
    Route::resource('professors', ProfessorController::class);
    Route::resource('signatures', SignatureController::class);
    Route::get('SignatureStudentsAndProfessors', [SignatureController::class, 'SignatureStudentsAndProfessors']);
    Route::get('StudentsSignatures', [StudentController::class, 'StudentsSignatures']);
    Route::get('ProfessorsSignatures', [ProfessorController::class, 'ProfessorsSignatures']);
});

Route::get('auth/logout', [AuthController::class, 'logout']);
