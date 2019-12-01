<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $table='product_order';
    public $timestamps=false;

    public function order()
    {
        return $this->belongsTo('App\models\Order', 'order_id', 'id');
    }
}
