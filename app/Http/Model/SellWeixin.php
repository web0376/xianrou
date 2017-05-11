<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class SellWeixin extends Model
{
    protected $table='sell_weixin';
    protected $primaryKey='id';
    protected $fillable = ['weixin','price','status','stime','uid'];
    public $timestamps = false;
}
