<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory;

    protected $fillable =['theater_id','row','seat_number'];

    public function ticketRef():HasMany
     {
        return $this->hasMany(Ticket::class,'seat_id','id');
     }

     public function theaterRef():HasOne
     {
        return $this->hasOne(Theater::class,'id','theater_id');
     }
}
