<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    public $timestamps=false;

    public function product()
    {
        return $this->hasMany('App\models\Product', 'category_id', 'id');
    }
}
