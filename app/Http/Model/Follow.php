<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table='follow';
    protected $primaryKey='id';
    protected $fillable = ['who_follow','follow_who','create_time'];
    public $timestamps = false;
}
