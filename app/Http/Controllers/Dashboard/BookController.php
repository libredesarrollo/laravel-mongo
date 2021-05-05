<?php

namespace App\Http\Controllers\Dashboard;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveBook;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->testBelongsManyFK();
        //$types = Book::distinct()->get(['type']);
        $types = DB::collection('books_collection')->distinct()->get(['type']);
        $books = Book::orderBy('created_at', 'desc');

        //*** filtro
        if (request('type'))
            $books->where('type', request('type'));

        if (request('mode_data')) {
            if (request('mode_type') == 'age') {

                //$years = Carbon::now()->subYear(request('mode_data'))->format('Y');
                $books->where('age', '>=', request('mode_data'));
            } else {
                // precio
                $books->where('price', '>=', request('mode_data'));
            }
        }

        //dd(request('classification'));

        if (request('classification'))
            $books->where('classification', 'all', request('classification'));

        //*** fin filtro

        //*** agregacion
        $detail = [];
        $detail['count'] = $books->count();
        $detail['max_price'] = $books->max('price');
        $detail['min_price'] = $books->min('price');
        $detail['avg_price'] = $books->avg('price');
        $detail['total'] = $books->sum('price');

        //var_dump($detail);

        //*** fin agregacion


        $lbooks = $books->paginate(10);

        return view('dashboard.book.index', ['books' => $lbooks, 'types' => $types, 'detail' => $detail]);
    }

    private function testBelongsManyFK()
    {
        // tagID 5f4bf09405640000c3003869   5f4bf09105640000c3003868
        // db.books_collection.find({_id:ObjectId("5f4bee7d05640000c3003867")}).pretty()
        $b = Book::find("5f495492637000001a0035cd");
        $t = Tag::find("5f4bf09105640000c3003868");

        //dd($b->tags[0]->title);

        $b->tags()->attach(
            $t
        );
    }

    private function testHasManyEmbedded()
    {
        // hacer pruebas con relacion de unos a muchos y documentos embebidos
        // _ID book ObjectId("5f494c01637000001a0035c8") 5f4aa44f54710000a20063e8  5f494c01637000001a0035c8

        $b = Book::find("5f47fcfa40090000c500688b");
        $c = Category::first()->ToArray();

        //dd($c);
        //dd($b);
        //dd($b->category());

        $b->push('categories', $c);

        $b->save();

        dd($b->categories);
    }

    private function testHasManyFK()
    {
        // hacer pruebas con relacion Uno a muchos y viceversa con belongsTo y HasMany
        // _ID book 5f4aa44f54710000a20063e8  5f494c01637000001a0035c8

        $b = Book::find("5f494c01637000001a0035c8");
        $c = Category::first();

        //dd($c);
        //dd($b);
        //dd($b->category());
        //dd($c->books());

        // $b->category()->save($c); NO VA A FUNCIONAR
        $c->books()->save($b);
        //dd($c->books);

        dd($b->category);
    }

    private function testHasOneFK()
    {
        // hacer pruebas con relacion hasOne
        // _ID book 5f4aa44f54710000a20063e8  5f494c01637000001a0035c8

        $b = Book::find("5f494c01637000001a0035c8");
        $c = Category::first();

        //dd($c);
        //dd($b);
        //dd($b->category());

        $b->category()->save($c);

        dd($b->category->title);
    }

    private function testHasOneEmbedded()
    {
        // hacer pruebas con relacion hasOne documentos embebidos
        // _ID book ObjectId("5f494c01637000001a0035c8") 5f4aa44f54710000a20063e8  5f494c01637000001a0035c8

        $b = Book::find("5f494c01637000001a0035c8");
        $c = Category::first()->ToArray();

        //dd($c);
        //dd($b);
        //dd($b->category());

        $b->category = $c;

        $b->save();

        dd($b->category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.book.create', ['book' => new Book(), 'categories' => Category::pluck('_id', 'title')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveBook $request)
    {
        Book::create($request->validated());
        return back()->with('status', 'Libro creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //dd($book);
        return view('dashboard.book.edit', [
            'book' => $book,
            'categories' => Category::pluck('_id', 'title'),
            'tags' => Tag::pluck('_id', 'title')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(SaveBook $request, Book $book)
    {
        $data = $request->validated();

        $data['price'] = (float)$data['price'];
        $data['age'] = (int)$data['age'];

        $book->update($data);
        return back()->with('status', "Libro " . $book->title . " actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with('status', "Libro eliminado correctamente");
    }

    public function tag_add(Book $book, Tag $tag)
    {
        $book->tags()->attach($tag);
    }

    public function tag_destroy(Book $book, Tag $tag)
    {
        $book->tags()->detach($tag);
    }
}
