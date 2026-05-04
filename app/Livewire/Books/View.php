<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Livewire\Component;

class View extends Component
{
    public $book;

    public function mount($id)
    {
        // eager loading
        $this->book = Book::with('category', 'creator')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.books.view');
    }
}