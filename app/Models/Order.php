<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'customer_id','number','total_price','status','shipping_price','notes'

    ];

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items():HasMany
    {
        return $this->hasMany(OrderItem::class);
    }


}
