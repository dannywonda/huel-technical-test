<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\UserResource;
use App\User;
use App\Http\Api\OrdersApi;

class OrderResource extends Resource
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
            'id'                    => $this->id,
            'number'                => $this->number,
            'name'                  => !is_null($this->name) ? $this->name : null,
            'total_price'           => "£" . number_format((float)$this->total_price, 2, '.', ''),
            'customer'              => User::find($this->user_id) ?? null,
            'date'                  => date('M j \a\t g:i a', strtotime($this->date)),
            'financial_status'      => self::getFinacialStatus()[$this->financial_status],
            'fulfillment_status'    => self::getFulfillmentStatus()[$this->fulfillment_status],
            'items'                 => count(json_decode($this->items, true)) . ' item',
            'tags'                  => $this->tags
        ];
    }

    public static function getFinacialStatus()
    {
        return [
            OrdersApi::FINANCIAL_STATUS_AUTHORIZED => 
            [
               'name'   => 'Authorized',
               'colour' => 'success'
            ],
            OrdersApi::FINANCIAL_STATUS_PAID => 
            [
                'name'   => 'Paid',
                'colour' => 'success'
            ],
            OrdersApi::FINANCIAL_STATUS_PARTIALLY_REFUNDED => 
            [
                'name'   => 'Partially Refunded',
                'colour' => 'primary'
            ],
            OrdersApi::FINANCIAL_STATUS_PARTIALLY_PAID => 
            [
                'name'   => 'Partially Paid',
                'colour' => 'secondary'
            ],
            OrdersApi::FINANCIAL_STATUS_PENDING =>
            [
                'name'   => 'Pending',
                'colour' => 'warning'
            ],
            OrdersApi::FINANCIAL_STATUS_REFUNDED => 
            [
                'name'   => 'Refunded',
                'colour' => 'success'
            ],
            OrdersApi::FINANCIAL_STATUS_UNPAID => 
            [
                'name'   => 'Unpaid',
                'colour' => 'danger'
            ],
            OrdersApi::FINANCIAL_STATUS_VOIDED => 
            [
                'name'   => 'Voided',
                'colour' => 'danger'
            ],
        ];
    }
    
    public static function getFulfillmentStatus()
    {
        return [
            OrdersApi::FULFILLMENT_STATUS_FULFILLED => 
            [
                'name'    => 'Fulfilled',
                'colour'  => 'success'
            ],
            OrdersApi::FULFILLMENT_STATUS_UNFULFILLED => 
            [
                'name'   =>  'Unfulfilled',
                'colour' =>  'danger'
            ],
            OrdersApi::FULFILLMENT_STATUS_PARTIALLY_FULFILLED =>
            [
                'name'      => 'Partially Fulfilled',
                'colour'    => 'secondary'
            ],
            OrdersApi::FULFILLMENT_STATUS_SCHEDULED =>
            [
                'name'  =>  'Scheduled',
                'colour' => 'warning'
            ]
        ];
    }
}
