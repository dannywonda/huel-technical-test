<?php 

namespace App\Http\Api; 

use App\Http\Api\ApiControl;
use App\Product;
use App\Tag;
use App\ProductVariant;

class ProductsApi extends ApiControl {

    const STATUS_ACTIVE  = 1;
    const STATUS_DRAFT   = 2;
    const STATUS_ACHIEVED = 3;

    /**
     * Store the product from the API
     * 
     */
    public static function storeProductFromApi() {
        // get the inforation from the api
        $data = new ApiControl('products');
        $productData = $data->retrieveInformation();

        foreach ($productData->products as $product) {
            $addedProduct = Product::updateOrCreate(
                [
                    'id'                    => $product->id ?? null,
                ],
                [
                    'id'                    => $product->id ?? null,
                    'title'                 => $product->title ?? null,
                    'body_html'             => $product->body_html ?? null,
                    'vendor'                => $product->vendor ?? null,
                    'product_type'          => $product->product_type ?? null,
                    'created_at'            => date('Y-m-d H:i:s', strtotime($product->created_at)),
                    'handle'                => $product->handle ?? null,
                    'published_at'          => date('Y-m-d H:i:s', strtotime($product->published_at)),
                    'status'                => $product->status ? 1 : 0,
                    'published_scope'       => $product->published_scope ?? null,
                    'admin_graphql_api_id'  => $product->admin_graphql_api_id ?? null,
                ]
            );

            $tags = self::retrieveTags($product->tags);
            foreach ($tags as $key => $value) {
                $addedProduct->tags()->attach($value);
            }
            

            foreach ($product->variants as $variants)
            {
                ProductVariant::updateOrCreate(
                    [
                        'id'                        => $variants->id,
                    ],
                    [
                        'id'                        => $variants->id,
                        'product_id'                => $variants->product_id,
                        'title'                     => $variants->title,
                        'price'                     => $variants->price,
                        'sku'                       => $variants->sku,
                        'position'                  => $variants->position,
                        'inventory_policy'          => $variants->inventory_policy,
                        'compare_at_price'          => $variants->compare_at_price,
                        'fulfillment_service'       => $variants->fulfillment_service,
                        'inventory_management'      => $variants->inventory_management,
                        'option1'                   => $variants->option1,
                        'option2'                   => $variants->option2,
                        'option3'                   => $variants->option3,
                        'created_at'                => date('Y-m-d H:i:s',  strtotime($variants->created_at)),
                        'updated_at'                => date('Y-m-d H:i:s',  strtotime($variants->updated_at)),
                        'taxable'                   => $variants->taxable,
                        'barcode'                   => $variants->barcode,
                        'grams'                     => $variants->grams,
                        'weight'                    => $variants->weight,
                        'weight_unit'               => $variants->weight_unit,
                        'inventory_item_id'         => $variants->inventory_item_id,
                        'inventory_quantity'        => $variants->inventory_quantity,
                        'old_inventory_quantity'    => $variants->old_inventory_quantity,
                        'tax_code'                  => $variants->tax_code,
                        'requires_shipping'         => $variants->requires_shipping,
                        'admin_graphql_api_id'      => $variants->admin_graphql_api_id
                    ]
                );
            }
        }
    }

    /**
     * Key for status
     * 
     * @return array
     */
    public static function getFinacialStatus()
    {
        return [
            'active'    => self::STATUS_ACTIVE,
            'draft'     => self::STATUS_DRAFT,
            'achieved'  => self::STATUS_ACHIEVED,
        ];
    }

        /**
     * Retriving the tags
     * 
     * @return array
     */
    public static function retrieveTags($receivedTags)
    {
        $getTag = [];

        $tagsSplit = explode(',' , $receivedTags);
    
        foreach ($tagsSplit as $key => $value)
        {
            $value = str_replace(' ', '', $value);
            $tag = Tag::updateOrCreate(
                [
                    'name' => $value,
                ],
                [
                    'name' => $value,
                    'slug' => $value
                ]
            );
            $getTag[] = $tag;
        }

        return $getTag;
    }
}