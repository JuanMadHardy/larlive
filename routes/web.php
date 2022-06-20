<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\NodeController;
use App\Http\Livewire\DeviceForm;
use App\Http\Livewire\EditNodeForm;
use App\Http\Livewire\NodesManagement;
use App\Mail\NodesMail;
use App\Models\Node;
use Illuminate\Support\Facades\Route as RouteAlias;

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

RouteAlias::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

RouteAlias::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

RouteAlias::get('/nodes/view', [DeviceController::class, 'show'])
    ->middleware(['auth'])
    ->name('nodes.show');

RouteAlias::get('/nodes/listnodes', [DeviceController::class, 'list'])
    ->middleware(['auth'])
    ->name('nodes.list');

RouteAlias::get('/nodes/create', DeviceForm::class)
    ->middleware(['auth'])
    ->name('nodes.create');

RouteAlias::get('/nodes/management', NodesManagement::class)
    ->middleware(['auth'])
    ->name('nodes.management');

RouteAlias::get('/nodes/edit/{id}', EditNodeForm::class)
    ->middleware(['auth'])
    ->name('nodes.edit');

Route::delete('/nodes/{id}', [NodeController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('nodes.destroy');


/*Route::get('/send-mail', function(){
   $details = [
       'title' => 'Mail from pruebas nodos',
       'body' => 'Este es el cuerpo del mensaje, el nodo esta desactivado'
   ];
   Mail::to('sergio.moron@malvon.es')->send(new NodesMail ($details));
});*/
RouteAlias::get('/nodes/getlastdata/{name}', [DeviceController::class, 'getlastdata'])
    ->middleware(['auth'])
    ->name('node.lastdata');
