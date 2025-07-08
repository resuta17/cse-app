<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $table = 'choices';
    
    protected $fillable = ['question_id', 'choice_text', 'is_correct','explanation'];
    
   public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
