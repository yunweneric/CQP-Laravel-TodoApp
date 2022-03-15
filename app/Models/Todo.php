<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    public $fillable = ['name', 'activity', 'state', 'dateline'];

    // public $hidden = ['id'];
}
