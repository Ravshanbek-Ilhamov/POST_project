<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = ['text','number_people'];


    public function options(){
        return $this->hasMany(Options::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
