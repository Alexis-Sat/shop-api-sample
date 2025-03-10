<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Order extends Model
{

    use HasEvents;
    /**
     * Constants to put status, with default 'pending'
     */
    public const ADDED = 1;
    public const PENDING = 0;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


}
