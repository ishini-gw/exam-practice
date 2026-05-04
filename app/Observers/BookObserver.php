<?php

namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        if (Auth::check()) {
            $book->created_by = Auth::id();
        }
    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        if (Auth::check()) {
            $book->updated_by = Auth::id();
        }
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
         if (Auth::check()) {
            $book->deleted_by = Auth::id();
            $book->save(); 
        }
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "force deleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        //
    }
}
