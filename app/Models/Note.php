<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function getRouteKeyName()
    {
      return 'uuid';   
    }

    public function user(){
      return $this->belongsTo(User::class,'user_id');
    }

    public function likes(){
      $this->hasMany(Like::class);
    }

    public function markdowns(){
      $this->hasMany(Markdown::class);
    }
}
