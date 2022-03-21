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
    
}
