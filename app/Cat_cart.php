<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat_cart extends Model
{
    public $table = "cat_carts";

    protected $guarded = [];

    public function suppler(){
        return $this->belongsTo('App\Suppliers','supper_id');
    }

}
