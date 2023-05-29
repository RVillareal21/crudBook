<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name',
        'author'
    ];

    public $sortable = ['id', 'name', 'author', 'created_at', 'updated_at'];

}
