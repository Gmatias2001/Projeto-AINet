<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable =['screening_id','seat_id','purchase_id','price','qrcode_url','status'];

    public function purchaseRef():HasOne
     {
        return $this->hasOne(Purchase::class,'purchase_id','id');
     }

     public function screeningRef():HasOne
     {
        return $this->hasOne(Screening::class,'screening_id','id');
     }

     public function seatRef():HasOne
     {
        return $this->hasOne(Seat::class,'seat_id','id');
     }
}
