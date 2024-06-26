<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Genre extends Model
{
    use HasFactory;

    protected $fillable =['nome'];

    public function movieRef():HasMany
    {
       return $this->hasMany(Movie::class,'genre_code','code');
    }
}
