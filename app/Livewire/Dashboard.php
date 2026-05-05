<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        
        $totalBooks = Book::count();
        
        $booksByCategory = Category::withCount('books')->get();

        $outOfStock = Book::where('available_copies', 0)->count();

        $totalValue = Book::sum('price');

        $recentBooks = Book::latest()->take(5)->get();

        return view('livewire.dashboard', compact(
            'totalBooks',
            'booksByCategory',
            'outOfStock',
            'totalValue',
            'recentBooks'
        ));
    }
}
