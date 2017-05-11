<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table='picture';
    protected $primaryKey='id';
    protected $fillable = ['type','path','url','create_time','width','height'];
    public $timestamps = false;
}
