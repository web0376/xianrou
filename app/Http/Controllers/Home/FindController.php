<?php
/**
 * Created by PhpStorm.
 * Author   : 592web QQ727532459
 * Time     : 2017-05-11 11:16:43
 * version  : 发现
 **/
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class FindController extends Controller
{
    public function index()
    {
        echo rand();
    }
}

