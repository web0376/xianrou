<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table='support';
    protected $primaryKey='id';
    protected $fillable = ['w_id','uid','stime'];
    public $timestamps = false;
}
