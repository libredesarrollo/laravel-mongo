<?php

use App\Book;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {

    /*
    //*** Crear documentos (libros)

    // crear con algunos parametros
    Book::create(
        ['title' =>"the witcher"]
    );
    Book::create(
        ['title' =>"the witcher",'description' => "Hola Mundo"]
    );

    // Buscar por where
    //$books = Book::where('title', "Cualquier cosa")->get(); 
    
    // buscar libros dado algunas condiciones
    $books = Book::where('title', "the witcher")
    //->whereNotNull('description')
    ->whereNull('description')
    //->toSql(); // ver SQL de la consulta
    ->get(); 
    // $books = Book::all(); obtener todos los documentos de la coleccion
    //dd($books);

    // buscar por ID del documento
    $b = Book::find('5f47fde040090000c500688f')->increment('age');

    // actualizar libro seleccionado
    $b->update(['title' =>"the witcher 2.0", 'age' => 2017]);

    // borrar libro seleccionado
    $b->delete();

    // encontrar por ID
    $b = Book::find('5f47fde040090000c500688f');
    */

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'auth'], function () {
    Route::resource('book', 'BookController');
    Route::resource('category', 'CategoryController');
    Route::resource('tag', 'TagController');
    Route::get('tag/add/{book}/{tag}','BookController@tag_add');
    Route::get('tag/destroy/{book}/{tag}','BookController@tag_destroy');

    Route::get('test/elem_match','TestController@test');
    Route::get('test/in','TestController@in');
    Route::get('test/exist','TestController@in');
    Route::get('test/size','TestController@size');
    Route::get('test/array_position','TestController@array_position');
    Route::get('test/mayor_a','TestController@mayor_a');
    Route::get('test/menor_a','TestController@menor_a');
    Route::get('test/slice','TestController@slice');
    Route::get('test/pagination','TestController@pagination');
    Route::get('test/where_raw','TestController@where_raw');
    Route::get('test/raw','TestController@raw');

    Route::get('/','CalendarController@index');

    Route::post('/event/file/{event}','CalendarController@file')->name("event.file");
});
