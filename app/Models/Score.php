<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    public function student() {
        return $this->belongsTo('App\Models\Students');
    }

    public function course() {
        return $this->belongsTo('App\Models\Courses');
    }

    protected $fillable = [
        'score',
        'student_id',
        'course_id',
    ];
}
