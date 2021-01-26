<?php 

namespace App\Http\Api; 

use App\Http\Api\ApiControl;
use App\Order;
use App\Tag;
use App\User;

// Strawberry is inherited from Fruit
class OrdersApi extends ApiControl {

    const FINANCIAL_STATUS_AUTHORIZED              = 1;
    const FINANCIAL_STATUS_PAID                    = 2;
    const FINANCIAL_STATUS_PARTIALLY_REFUNDED      = 3;
    const FINANCIAL_STATUS_PARTIALLY_PAID          = 4;
    const FINANCIAL_STATUS_PENDING                 = 5;
    const FINANCIAL_STATUS_REFUNDED                = 6;
    const FINANCIAL_STATUS_UNPAID                  = 7;
    const FINANCIAL_STATUS_VOIDED                  = 8;

    const FULFILLMENT_STATUS_FULFILLED              = 1;
    const FULFILLMENT_STATUS_UNFULFILLED            = 2;
    const FULFILLMENT_STATUS_PARTIALLY_FULFILLED    = 3;
    const FULFILLMENT_STATUS_SCHEDULED              = 4;


    /**
     * Store the orders from the API
     * 
     */
    public static function storeOrdersFromApi() {
        $data = new ApiControl('orders');
        $orderData = $data->retrieveInformation();
    
        foreach ($orderData->orders as $order) {
            $addedOrder = Order::updateOrCreate(
                [
                    'id'                    => $order->id,
                    'name'                  => $order->name,
                ],
                [
                    'id'                    => $order->id ?? null,
                    'name'                  => $order->name,
                    'number'                => $order->number ?? null,
                    'user_id'               => $order->customer->id ?? null,
                    'created_at'          => date('Y-m-d H:i:s', strtotime($order->created_at)),
                    'updated_at'            => date('Y-m-d H:i:s', strtotime($order->updated_at)),
                    'total_price'           => $order->total_price,
                    'subtotal_price'        => $order->subtotal_price,
                    'total_weight'          => $order->total_weight,
                    'financial_status'      => self::getFinacialStatus()[$order->financial_status],
                    'fulfillment_status'    => self::getFulfillmentStatus()[$order->fulfillment_status] ?? self::FULFILLMENT_STATUS_UNFULFILLED,
                    'items'                 => json_encode($order->line_items),
                    'token'                 => $order->token,
                    'remaining_items'       => json_encode($order)
                ]
            );

            if (!empty($order->customer)) {
                $user = $order->customer;
                User::updateOrCreate(
                    [  
                        'id'                => $user->id,
                        'email'             => $user->email,
                    ],
                    [
                        'id'                => $user->id,
                        'email'             => $user->email,
                        'name'              => $user->first_name . ' ' . $user->last_name,
                        'first_name'        => $user->first_name ?? null,
                        'last_name'         => $user->last_name ?? null,
                        'orders_count'      => $user->orders_count,
                        'state'             => $user->state === 'disabled' ? 1 : 0,
                        'total_spent'       => $user->total_spent,
                        'currency'          => $user->currency,
                        'remaining_items'   => json_encode($user),
                    ]
                );
            }

            $tags = self::retrieveTags($order->tags);
            foreach ($tags as $key => $value) {
                $addedOrder->tags()->attach($value);
            }
        }
    }

    /**
     * Key for financial status
     * 
     * @return array
     */
    public static function getFinacialStatus()
    {
        return [
            'authorized'            => self::FINANCIAL_STATUS_AUTHORIZED,
            'paid'                  => self::FINANCIAL_STATUS_PAID,
            'partially_refunded'    => self::FINANCIAL_STATUS_PARTIALLY_REFUNDED,
            'partially_paid'        => self::FINANCIAL_STATUS_PARTIALLY_PAID,
            'pending'               => self::FINANCIAL_STATUS_PENDING,
            'refunded'              => self::FINANCIAL_STATUS_REFUNDED,
            'unpaid'                => self::FINANCIAL_STATUS_UNPAID,
            'voided'                => self::FINANCIAL_STATUS_VOIDED
        ];
    }

    /**
     * Key for fulfillment status
     * 
     * @return array
     */
    public static function getFulfillmentStatus()
    {
        return [
            'fulfilled'             => self::FULFILLMENT_STATUS_FULFILLED,
            'unfulfilled'           => self::FULFILLMENT_STATUS_UNFULFILLED,
            'partially_fulfilled'   => self::FULFILLMENT_STATUS_PARTIALLY_FULFILLED,
            'scheduled'             => self::FULFILLMENT_STATUS_SCHEDULED,
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
            $tag = str_replace(' ', '', $value);
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