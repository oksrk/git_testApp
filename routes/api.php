<?php
use App\Http\Controllers\Api\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CompanyClaimController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('todo/create', [TodoController::class, 'store'])->name('api.todo.create');
Route::get('todo/{id}/show', [TodoController::class, 'show'])->name('api.todo.show');
Route::put('todo/{id}/update', [TodoController::class, 'update'])->name('api.todo.update');
Route::delete('todo/{id}/destroy', [TodoController::class, 'destroy'])->name('api.todo.destroy');

Route::post('company/create', [CompanyController::class, 'store'])->name('api.company.create');
Route::get('company/{id}/show', [CompanyController::class, 'show'])->name('api.company.show');
Route::put('company/{id}/update', [CompanyController::class, 'update'])->name('api.company.update');
Route::delete('company/{id}/destroy', [CompanyController::class, 'destroy'])->name('api.company.destroy');

Route::post('companyclaim/create', [CompanyClaimController::class, 'store'])->name('api.companyclaim.create');
Route::get('companyclaim/{id}/show', [CompanyClaimController::class, 'show'])->name('api.companyclaim.show');
Route::put('companyclaim/{id}/update', [CompanyClaimController::class, 'update'])->name('api.companyclaim.update');
Route::delete('companyclaim/{id}/destroy', [CompanyClaimController::class, 'destroy'])->name('api.companyclaim.destroy');

