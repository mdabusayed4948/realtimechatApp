<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //    protected $fillable = [
    //        'title', 'slug', 'body', 'category_id', 'user_id',
    //    ];

    // use for store huge data
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
