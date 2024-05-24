<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExameQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'correct_answer',
        'paper_id',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }


}
