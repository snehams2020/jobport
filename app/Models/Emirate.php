<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emirate extends Model
{
    use HasFactory;

    protected $table = 'emirates';

    
    protected $fillable = [
        'title',
        'description',
       
    ];

    

}
