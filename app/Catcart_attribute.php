<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Catcart_attribute extends Model
{
    public $table = "catcart_attributes";
    protected $guarded = [];
    public function cart(){
        return $this->belongsTo('App\Cat_cart','catcart_id');
    }

}
