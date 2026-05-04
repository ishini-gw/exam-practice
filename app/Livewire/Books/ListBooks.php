<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination; 

class ListBooks extends Component
{
    use WithPagination;

    public $showTrashed = false;

    public $search = '';

    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedShowTrashed()
    {
        $this->resetPage();
    }

    public function render()
    {
         $query = Book::with('category', 'creator');

        
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('author', 'like', '%' . $this->search . '%')
                  ->orWhere('isbn', 'like', '%' . $this->search . '%');
            });
        }

        
        if ($this->showTrashed) {
            $query->onlyTrashed();
        }

        $books = $query->latest()->paginate(8);

        return view('livewire.books.list-books', compact('books'));
    }

 
    public function delete($id)
    {
        Book::find($id)?->delete();
        $this->resetPage();
    }

   public function restore($id)
    {
        $book = Book::withTrashed()->find($id);

        if ($book && $book->trashed()) {
            $book->restore();
        }

        $this->resetPage();
    }

    public function forceDelete($id)
    {
        $book = Book::withTrashed()->find($id);

        if ($book && $book->trashed()) {
            $book->forceDelete();
        }

        $this->resetPage();
    }
}
