<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class WeiboCom extends Model
{
    protected $table='weibo_comment';
    protected $primaryKey='id';
    protected $fillable = ['uid','weibo_id','content','create_time','status'];
    public $timestamps = false;
}
