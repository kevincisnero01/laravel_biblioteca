<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManamentTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_book_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/books', [
            'title' => 'Libro de prueba',
            'author' => 'Autor de prueba'
        ]);

        $response->assertStatus(201);

        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required(){

        $response = $this->post('/api/books',[
            'title' => '',
            'author' => 'Autor de prueba'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required(){

        $response = $this->post('/api/books',[
            'title' => 'Libro de prueba',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated(){

        $this->withoutExceptionHandling();

        $this->post('/api/books',[
            'title' => 'Libro de prueba',
            'author' => 'Autor de prueba'
        ]);
        
        $book = Book::first();

        $this->put('/api/books/'. $book->id ,[
            'title' => 'Nuevo Libro de prueba',
            'author' => 'Nuevo Autor de prueba'
        ]);
        
        $this->assertEquals('Nuevo Libro de prueba', Book::first()->title);
        $this->assertEquals('Nuevo Autor de prueba', Book::first()->author);

    }

    /** @test */
    public function a_book_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/api/books',[
            'title' => 'Libro de prueba',
            'author' => 'Autor de prueba'
        ]);

        $book = Book::first();
        $this->assertCount(1, Book::all());

        $this->delete('/api/books/'. $book->id);

        $this->assertCount(0, Book::all());
    }
    
}
