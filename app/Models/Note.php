<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'todo_id', 'user_id'];

    public function todo()
    {
        return $this->belongsTo(Todo::class, 'todo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
