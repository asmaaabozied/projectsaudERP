<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Marpurchase extends Model
{
    public $table = "marpurchases";

    protected $guarded = [];

    public function suppler(){
        return $this->belongsTo('App\Suppliers','supper_id');
    }

    public function store(){
        return $this->belongsTo('App\Store','store_id');
    }

}
