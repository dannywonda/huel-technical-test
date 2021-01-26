<?php 

namespace App\Http\Api; 

use App\Http\Api\ApiControl;
use App\User;

class UsersApi extends ApiControl {

    /**
     * Store the users from the API
     * 
     */
    public static function storeCustomersFromApi() {
        $data = new ApiControl('customers');
        $usersData = $data->retrieveInformation();
        
        foreach ($usersData->customers as $user) {
            if (!is_null($user)) {
                User::updateOrCreate(
                    [  
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
        }
    }
}