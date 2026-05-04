<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

     public function updator(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    //scopes
    public function scopeAvailability($query){
        return $query->where('available_copies', '>', 0);
    }

    public function scopeExpensive($query){
        return $query->where('price', '>', '1000');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
