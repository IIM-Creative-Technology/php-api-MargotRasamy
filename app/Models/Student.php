<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function promotion() {
        return $this->belongsTo('App\Models\Promotion');
    }

    public function score() {
        return $this->hasMany('App\Models\Score');
    }

    protected $fillable = [
        'firstname',
        'lastname',
        'age',
        'arrival_year',
        'promotion_id',
    ];
}
