<?php

namespace App\Livewire\Books;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.books.create');
    }

    public $title;
    public $author; 
    public $isbn; 
    public $description;
    public $published_date;
    public $pages;
    public $price;
    public $available_copies; 
    public $total_copies; 
    public $publisher;
    public $category_id;

    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',

            'isbn' => [
                'required',
                'unique:books,isbn',
                'regex:/^\d{10}(\d{3})?$/'
            ],

            'description' => 'nullable|string',

            'published_date' => 'required|date|before_or_equal:today',

            'pages' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',

            'available_copies' => 'required|integer|min:0',
            'total_copies' => 'required|integer|min:0',

            'publisher' => 'nullable|string|max:255',

            'category_id' => 'required|exists:categories,id',
        ]);

        Book::create([
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'description' => $this->description,
            'published_date' => $this->published_date,
            'pages' => $this->pages,
            'price' => $this->price,
            'available_copies' => $this->available_copies,
            'total_copies' => $this->total_copies,
            'publisher' => $this->publisher,
            'category_id' => $this->category_id,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('books.index');
    }
}
