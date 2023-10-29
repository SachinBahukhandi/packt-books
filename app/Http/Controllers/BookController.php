<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
            'publisher',
        ];
        $data = [
            'books' => Book::all(),
            'columns' => $columns,

        ];
        if (request()->expectsJson()) {

            $data['books'] = $data['books']->map(function ($book) {
                $user = request()->user();
                if ($user) {
                    $book->edit = route('books.edit', $book->id);
                    $book->delete = route('books.destroy', $book->id);
                }


                return $book;
            });
            $books = [
                'data' => $data['books'],
                'recordsTotal' => $data['books']->count(),
                'recordsFiltered' => 10,
                'draw' => time(),
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
        return Inertia::render(
            'Books/Edit',
            [
                'book' => $book,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $response = [
            'success' => true,
            'message' => 'Deleted Successfully!',
        ];

        try {
            $book->delete();
        } catch (QueryException $e) {
            $response = [
                'success' => false,
                'message' => 'Deletion Unsuccessful!',
            ];
        }

        if (request()->expectsJson()) {
            return response()->json($response);
        } else {
            return redirect()->back();
        }
    }
}
