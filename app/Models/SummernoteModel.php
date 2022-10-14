<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummernoteModel extends Model
{
    use HasFactory;
    protected $table = 'summernote';
    protected $fillable=[
        'title',
        'description'
    ];

}
