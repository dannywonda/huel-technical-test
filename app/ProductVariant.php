<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'id',
        'title',
        'product_id',
        'price',
        'sku',
        'position',
        'inventory_policy',
        'compare_at_price',
        'fulfillment_service',
        'inventory_management',
        'option1',
        'option2',
        'option3',
        'taxable',
        'barcode',
        'grams',
        'image_id',
        'weight',
        'weight_unit',
        'inventory_item_id',
        'inventory_quantity',
        'old_inventory_quantity',
        'tax_code',
        'requires_shipping',
        'admin_graphql_api_id'
    ];
}
