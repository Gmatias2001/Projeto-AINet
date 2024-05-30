<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $fillable =['nif','payment_type','payment_ref'];

    public function purchaseRef():HasMany
    {
       return $this->hasMany(Purchase::class,'id','customer_id');
    }

    public function userRef():HasOne
    {
       return $this->hasOne(User::class,'id','id');
    }
}
