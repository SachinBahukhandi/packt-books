<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

/**
 * Book Controller resource
 */
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $columns = [
            'title',
            'author',
            'genre',
            'description',
            'isbn',
            'image',
            'published',
            'publisher'
        ];
        $data = [
            'books' => Book::all(),
            'columns' => $columns

        ];
        if (request()->expectsJson()) {

            $books = [
                'data' =>$data['books'],
                'recordsTotal' =>  $data['books']->count(),
                'recordsFiltered'=> 10,
                'draw' => time()
            ];
            return response()->json($books);
        }
        return Inertia::render(
            'Books/List',
            $data
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
