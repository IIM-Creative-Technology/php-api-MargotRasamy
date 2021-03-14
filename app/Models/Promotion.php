<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }


    protected $fillable = [
        'name',
        'year',
    ];
}
