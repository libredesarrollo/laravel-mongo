<?php

namespace App\Http\Controllers\Dashboard;

use App\Book;
use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function elem_match()
    {
        $data = Book::where(['category_id' => "5f4aa63854710000a20063ea"])->get(); // query simple
        $data = Book::where(['categories' => ['$elemMatch' => ['title' => ['$in' => ['Terror2', 'Terror3']]]]])->get(); // $elemMatch y $in
        /*$data = Book::where(['categories' => 
         [ '$or' => ['$elemMatch' => ['title' => ['$in' => ['Terror2', 'Terror3']]]] ]
        
        ])->get();*/ // $elemMatch y $in y $or NO FUNCIONA

        $data = Book
            ::where(['categories' => ['$elemMatch' => ['title' => ['$in' => ['Terror2', 'Terror3']]]]])
            ->orWhere(['categories' => ['$elemMatch' => ['_id' => ['$in' => ['Terror4', 'Terror5']]]]])
            ->get(); // $elemMatch y $in y $or

        $data = Book::where(['categories' => ['$elemMatch' => ['title' => ['$eq' => 'Terror2', '$eq' => 'Terror3']]]])->get(); // $elemMatch y $eq
        $data = Book::where(['classification' => ['$elemMatch' => ['$eq' => 'A']]])->get(); // $elemMatch y $eq array


        dd($data);
    }

    public function in()
    {
        $data = Event::where('allday', false)->get(); // allday = true
        $data = Event::where('allday', ['$in' => [false, true]])->get(); // allday in [true, cualquier cosa]

        dd($data);
    }
    public function exist()
    {
        $data = Event::where('allday', ['$exists' => true])->get(); // allday in [true, cualquier cosa]
        $data = Event::where('allday', 'exists', false)->get(); // si existe un campo

        dd($data);
    }

    public function size()
    {
        $data = Book::where("classification", 'size', 1)->get(); // buscar por tamanos de array
        $data = Book::where("classification", ['$size' => 1])->get(); // buscar por tamanos de array
        //$data = Book::where("classification", 'gt', 1)->get(); //  NO VA A FUNCIONAR PARA MANEJAR TAMANO DE ARRAY

        dd($data);
    }
    public function array_position()
    {
        $data = Book::where("classification.0", 'B')->get(); // buscar por un elemento en particular en un array

        dd($data);
    }
    public function mayor_a()
    {
        $data = Book::where("classification.0", 'exists', true)->get(); // >=

        dd($data);
    }
    public function menor_a()
    {
        $data = Book::where("classification.1", 'exists', false)->get(); // <=  classification.lenght < 2

        dd($data);
    }
    public function slice()
    {
        $data = Book::project(['classification' => ['$slice' => 2]])->get();
        $data = Book::project(['classification' => ['$slice' => [1, 2]]])->get();

        dd($data);
    }

    public function pagination()
    {
        $data = Book::paginate(3, ["_id", "title"]);

        dd($data);
    }

    public function where_raw()
    {
        $data = Book::whereRaw([
            //'price' => 6.11
            'price' => [
                '$gt' => 5,
                '$lt' => 20,
            ]
        ])->get();

        dd($data);
    }
    public function raw()
    {
        $data = Book::raw(
            function($collection){
                return $collection->find(
                    [
                        'price' => [
                            '$gt' => 5,
                            '$lt' => 20,
                        ],
                        'description' => "Hola mundo 2"
                    ], // wheres
                    [
                        'projection' => ['price' => 1,'description' => 1]
                    ] // proyecciones por ejemplo
                );
            }
        );

        dd($data);
    }
}
