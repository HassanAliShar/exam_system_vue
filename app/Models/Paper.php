<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_id'
    ];

    // public function questions()
    // {
    //     return $this->hasMany(Question::class);
    // }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
