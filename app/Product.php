<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'title',
        'body_html',
        'vendor',
        'product_type', 
        'handle',
        'published_at',
        'template_suffix',
        'status',
        'published_scope',
        'tags',
        'admin_graphql_api_id',
        'variants',
        'options',
        'images',
        'image'
    ];

    /**
    * Order can have many tags
    */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
