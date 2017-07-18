<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Log;

class WechatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
                switch ($message->MsgType) {
                    case 'event'://事件
                        if($message->Event == 'subscribe') {//关注事件
                            $openid = $message->FromUserName;
                            DB::table('wechat_user')->insertGetId(
                                ['openid' => $openid]
                            );
                            Log::info($openid.' subscribed');
                            return '你终于发现我啦小主';
                        }
                        break;
                    case 'text'://文字信息
                        Log::info('Msg: '.$message->Content);
                        return $message->Content.'，我是复读机略略略';
                        break;
                    case 'image'://图片
                        return '收到图片消息';
                        break;
                    case 'voice'://语言
                        return '收到语音消息';
                        break;
                    case 'video'://视频
                        return '收到视频消息';
                        break;
                    case 'location'://坐标
                        return '收到坐标消息';
                        break;
                    case 'link'://连接
                        return '收到链接消息';
                        break;
                    // ... 其它消息
                    default://其他
                        return '收到其它消息';
                        break;
                }
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }
}