<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Screening extends Model
{
    use HasFactory;

    protected $fillable =['movie_id','theater_id','date','start_time'];

    public function ticketRef():HasMany
    {
       return $this->hasMany(Ticket::class,'id','screening_id');
    }

    public function theaterRef():HasOne
    {
       return $this->hasOne(Theater::class,'theater_id','id');
    }

    public function movieRef():HasOne
    {
       return $this->hasOne(Movie::class, 'id', 'movie_id'); //ORDEM CERTA
    }
}
