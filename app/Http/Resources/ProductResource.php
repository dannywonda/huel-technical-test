<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Api\ProductsApi;
use App\ProductVariant;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                  => $this->id,
            'name'                => $this->title,
            'status'              => self::getStatusValue()[$this->status],
            'product_type'        => $this->product_type ?? null,
            'vendor'              => $this->vendor,
            'tags'                => $this->tags,
            'variants'            => count(ProductVariant::where('product_id', $this->id)->get())
        ];
    }

    public static function getStatusValue()
    {
        return [
            ProductsApi::STATUS_ACTIVE => 
            [
                'name'    => 'Active',
                'colour'  => 'success'
            ],
            ProductsApi::STATUS_DRAFT => 
            [
                'name'   =>  'draft',
                'colour' =>  'danger'
            ],
            ProductsApi::STATUS_ACHIEVED =>
            [
                'name'      => 'achieved',
                'colour'    => 'secondary'
            ]
        ];
    }
}
