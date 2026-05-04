<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Livewire\Component;

class Search extends Component
{
    
    public $search = '';

    public function render()
    {
       

        $books = Book::where('title', 'like', '%' . $this->search . '%')->get();

        return view('livewire.books.search', compact('books'));    
    }
    
}
