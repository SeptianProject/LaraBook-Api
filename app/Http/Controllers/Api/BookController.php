<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // all
        // return BookResource::collection(Book::all());

        // page
        return BookResource::collection(Book::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        return new BookResource(Book::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        //
        // $book->update($request->validated());
        // return new BookResource($book);

        return new BookResource(tap($book)->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return response()->noContent();
    }
}
