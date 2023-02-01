<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UserChannel;
use App\Models\UserMessage;
use App\Models\UserMessageChannel;
use App\Models\UserCategory;
use Illuminate\Http\Request;                              
use App\Models\Message;
use Illuminate\Support\Facades\DB;                        
use App\Http\Services\NotifierService;
use App\Http\Services\ChannelServiceInterface;
use App\Http\Services\SmsChannelService;
use App\Http\Services\EmailChannelService;
use App\Http\Services\PushNotificationChannelService;


class NotifierController extends Controller
{
    const SMS = 1;
    const EMAIL = 2;
    const PUSH_NOTIFICATION = 3;

    private $notifier_service;

    public function __construct(NotifierService $notifierService){
        $this->notifier_service = $notifierService;
    }

    public function publish(Request $request)
    {

        try {
            $request->validate([
                'category_id' => 'required',
                'message' => 'required'
            ]);

            $category_id = $request->input('category_id');
            $message_text = $request->input('message');

            $response =  $this->notifier_service->publish($category_id, $message_text);

        } catch (\Exception $e) {
            $response = [
                'status'  => 0,
                'result'   => $e->getMessage(),
                'code' => 500
            ];
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getLog() {

        $messages = DB::table('messages as m')
            ->join('categories as ct', 'ct.id', '=', 'm.category_id')
            ->join('user_message as um', 'um.message_id', '=', 'm.id')
            ->join('users as u', 'u.id', '=', 'um.user_id')
            ->join('user_channel as uc', 'uc.user_id', '=', 'u.id')
            ->join('channels as ch', 'ch.id', '=', 'uc.channel_id')
            ->join('user_message_channel as umc', 'umc.user_message_id', '=', 'um.id')
            ->orderBy('m.created_at', 'desc')
            ->select('ct.category', 'm.message', 'u.name', 'ch.channel', 'm.created_at', 'uc.channel_id', 'um.message_id', 'um.user_id', 'umc.sent_ok')
            ->get();

        /* CONSOLIDATION to avoid repeated data */
        $log = [];
        foreach($messages as $message){
            $log[$message->created_at.'---'.$message->category.'---'.$message->message][$message->name][$message->channel] = $message->sent_ok;
        }

        return $log;
    }


}
