<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;

    public function promotion() {
        return $this->belongsTo('App\Models\Promotion');
    }

    public function teacher() {
        return $this->belongsTo('App\Models\Teacher');
    }

    protected $fillable = [
        'name',
        'start_at',
        'end_at',
        'end_at',
        'promotion_id',
        'teacher_id',
    ];
}
