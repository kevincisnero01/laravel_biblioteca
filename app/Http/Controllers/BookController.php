<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function store()
    {
        return Book::create($this->validateRequest());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function update(Book $book)
    {
        $book->update($this->validateRequest());
    }

    public function destroy(Book $book)
    {
        $book->delete();
    }

    public function validateRequest()
    {
        return $data = request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
    }
}
