<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Marpurchase_attribute extends Model
{
    public $table = "purchase_attributes";
    protected $guarded = [];

    public function cart()
    {
        return $this->belongsTo('App\Marpurchase', 'marpurchase_id');
    }

}
