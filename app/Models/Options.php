<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'text',
        'percentage',
        'number_people',
    ];

    public function requests(){
        return $this->belongsTo(Request::class, 'request_id');
    }   

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}

