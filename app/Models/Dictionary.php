<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{

    use HasFactory;

    protected $fillable = ['word_eng', 'word_ukr','example_sentences', 'image'];
}
