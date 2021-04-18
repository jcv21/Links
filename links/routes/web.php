<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Link;
use Illuminate\Http\Request;

// Register the routes
Auth::routes();

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

Route::get('/', function(Link $link){
    $data = $link::all();

    return view('welcome', ["links" => $data]);
});

Route::get('/submit', function(){
    return view('submit');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/submit', function(Request $request){
    $data = $request->validate([
        'title' => 'required|max:255',
        'url' => 'required|url|max:255',
        'description' => 'required|max:255',
    ]);

    $link = tap(new App\Models\Link($data))->save();

    return redirect('/');
});