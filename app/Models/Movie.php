<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    protected $fillable =['title','genre_code','year','poster_filename','synopsis','trailer_url'];

    public function genreRef():HasOne
     {
        return $this->hasOne(Genre::class,'genre_code','code');
     }

     public function screeningRef():HasMany
     {
        return $this->hasMany(Screening::class,'id','movie_id');
     }
}