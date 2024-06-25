<?php

namespace App\Models;

use App\Models\Receiver;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Order extends Model
{
    use HasFactory;


    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetails::class);
    }

}
