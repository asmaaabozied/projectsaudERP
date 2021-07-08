<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    public $table = "stores";

    protected $guarded = [];

    public function suppler(){
        return $this->belongsTo('App\Suppliers','supper_id');
    }

    public function store(){
        return $this->belongsTo('App\Store','store_id');
    }

}
