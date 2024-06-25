<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Department extends Model
{
    use HasFactory;
    use AsSource;
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];
}
