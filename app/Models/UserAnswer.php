<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'result_id',
        'question_id',
        'answer',
    ];

    public function result()
    {
        return $this->belongsTo(Result::class, 'result_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(ExameQuestion::class, 'question_id', 'id');
    }
}
