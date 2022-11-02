<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    protected $fillable = ['title',  'author', 'edition', 'no_of_pages','status'];
    use HasFactory;
}
