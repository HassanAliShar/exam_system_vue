<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'paper_id',
        'user_id',
        'correct_answer',
        'wrong_answer',
        'passing_marks',
        'obtained_marks',
        'percentage',
        'attempt',
        'status',
        'marks',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_answers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
