<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
