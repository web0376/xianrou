<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table='report';
    protected $primaryKey='id';
    protected $fillable = ['uid','wid','stime'];
    public $timestamps = false;
}
