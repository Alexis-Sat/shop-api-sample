<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    /** @use HasFactory<\Database\Factories\GoodFactory> */
    use HasFactory, HasEvents;


    protected $fillable = [
        'name',
        'price',
        'count'
    ];


    public function order()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
