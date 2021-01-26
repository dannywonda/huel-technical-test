<?php

namespace App\Http\Api;

class ApiControl {

    // type of the file need
    public $type;

    /**
     * Constructor
     */
    public function __construct($type) {
        $this->type = $type;
    }
  
    /**
     * Retrieving information from the API
     * 
     * @return response
     */
    public function retrieveInformation() {
        $api_key = env('SHOPIFY_APP_KEY');
        $code = env('SHOPIFY_CODE');

        $url = "https:// {$api_key}:{$code}@technical-be-74176.myshopify.com/admin/api/2021-01/{$this->type}.json";

        $client =  new \GuzzleHttp\Client();
        $res = $client->request('GET', $url);
         
        return json_decode($res->getBody()->getContents());
    }
}