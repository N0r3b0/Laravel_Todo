<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
	protected $guarded=[];

    protected $fillable = ['title','user_id'];

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
    // W modelu Todo.php
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

}
