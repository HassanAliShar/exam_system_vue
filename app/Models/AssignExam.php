<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'paper_id',
        'user_id',
        'from_date',
        'to_date',
        'total_marks',
        'passing_marks',
        'attempt',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
