<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['note_id','user_id','like'];

    public function note(){
        $this->belongsTo(Note::class,'note_id');
    }

    public function user(){
        $this->belongsTo(User::class,'user_id');
    }

    
}
