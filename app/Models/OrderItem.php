<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class OrderItem extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'good_id',
        'amount',
        'price',
        'order_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany(Good::class);
    }


}
