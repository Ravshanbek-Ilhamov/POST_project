<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOption\Option;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_IP',
        'request_id',
        'option_id',
    ];

    public function requests(){
        return $this->belongsTo(Request::class, 'request_id');
    }  

    public function option(){
        return $this->belongsTo(Options::class, 'option_id');
    }  
}
