<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function redis()
    {
        Redis::set('key', 'redis is load success');
        $values = Redis::get('key');
        dd($values);
        //输出："guwenjie"
        //加一个小例子比如网站首页某个人员或者某条新闻日访问量特别高，可以存储进redis，减轻内存压力
        // $userinfo = Member::find(1200);
        // Redis::set('user_key', $userinfo);
        // if (Redis::exists('user_key')) {
        //     $values = Redis::get('user_key');
        // } else {
        //     $values = Member::find(1200); //此处为了测试你可以将id=1200改为另一个id
        // }
        // dump($values);
    }
}
