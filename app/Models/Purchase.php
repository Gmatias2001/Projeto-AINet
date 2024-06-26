<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable =['customer_id','date','total_price','customer_name','customer_email','nif','payment_type','payment_ref','receipt_pdf_filename'];

    public function customerRef():HasOne
     {
        return $this->hasOne(Customer::class,'id','custumer_id');
     }

     public function ticketRef():HasMany
     {
        return $this->hasMany(Ticket::class,'screening_id','id');
     }
}
