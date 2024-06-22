<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class JobTitle extends Model
{
    use HasFactory;
    use AsSource;
    protected $fillable = [
        'id',
        'name',
        'supervisor',
        'created_at',
        'updated_at'
    ];
}
