<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Weibo extends Model
{
    protected $table='weibo';
    protected $primaryKey='id';
    protected $fillable = ['uid','content','create_time','status','type','data'];
    public $timestamps = false;
}
