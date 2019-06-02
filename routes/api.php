<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 默认生产的api路由，但我们要使用dingo api，先注释
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * 使用dingo api
 */
$api = app('Dingo\Api\Routing\Router');

$api->version(
    'v1',
    ['namespace' => 'App\Http\Controllers\Api'],
    function ($api) {
        // $api->get('version', function () {
        //     return response('this is version v1');
        // });

        // 增加api调用频率限制
        $api->group([
            'middleware' => 'api.throttle',
            'limit' => config('api.rate_limits.sign.limit'),
            'expires' => config('api.rate_limits.sign.expires'),
        ], function ($api) {
            // 短信验证码
            $api->post('verificationCodes', 'VerificationCodesController@store')
                ->name('api.verificationCodes.store');

            // 用户注册
            $api->post('users', 'UsersController@store')
                ->name('api.users.store');
        });
    }
);

$api->version('v2', function ($api) {
    $api->get('version', function () {
        return response('this is version v2');
    });
});
