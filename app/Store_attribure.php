<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Store_attribure extends Model
{
    public $table = "store_attribures";

    protected $guarded = [];

    public function suppler(){
        return $this->belongsTo('App\Suppliers','supper_id');
    }

}
