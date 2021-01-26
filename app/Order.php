<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'number',
        'date',
        'name',
        'fulfillment_status',
        'financial_status',
        'items',
        'delivery_method',
        'total_price',
        'remaining_items',
        'total_weight',
        'total_tax',
        'taxes_included'
    ];

    /**
    * Order can have many tags
    */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
