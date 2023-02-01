<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UserChannel;
use App\Models\UserMessage;
use App\Models\UserMessageChannel;
use App\Models\UserCategory;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;                              
use App\Models\Message;                                   
use App\Models\Category;                                  
use Illuminate\Support\Facades\DB;                        
use App\Services\NotifierService;


class NotifierController_funciona extends Controller
{
     /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'message' => 'required'
            ]);

            $category_id = $request->input('category_id');
            $message_text = $request->input('message');

            DB::beginTransaction();

            try {
                $message = new Message();
                $message->category_id = $category_id;
                $message->message = $message_text;
                $message->save();

                $users_categories = UserCategory::where('category_id', $message->category_id)->get();

                foreach ($users_categories as $user_category) {
                    $user_message = new UserMessage();
                    $user_message->user_id = $user_category->user_id;
                    $user_message->message_id = $message->id;
                    $user_message->save();

                    $users_channels = UserChannel::where('user_id', $user_message->user_id)->get();
                    foreach($users_channels as $user_channel) {
                        $user_message_channel = new UserMessageChannel();
                        $user_message_channel->channel_id = $user_channel->channel_id;
                        $user_message_channel->user_message_id = $user_message->id;
                        $user_message_channel->save();
                    }
                }
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

            DB::commit();

            $response = [
                'status' => 1,
                'result' => "Message saved",
                'code' => 200
            ];

        } catch (Exception $e) {
            $response = [
                'status'  => 0,
                'error'   => $e->getMessage(),
                'code' => 400
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
            ->leftJoin('categories as ct', 'ct.id', '=', 'm.category_id')
            ->leftJoin('user_message as um', 'um.message_id', '=', 'm.id')
            ->leftJoin('users as u', 'u.id', '=', 'um.user_id')
            ->leftJoin('user_channel as uc', 'uc.user_id', '=', 'u.id')
            ->leftJoin('channels as ch', 'ch.id', '=', 'uc.channel_id')
            ->orderBy('m.created_at', 'desc')
            ->select('ct.category', 'm.message', 'u.name', 'ch.channel', 'm.created_at', 'uc.channel_id', 'um.message_id', 'um.user_id')
            ->get();

        /* CONSOLIDATION */
        $log = [];
        foreach($messages as $message){
            $log[$message->created_at.'---'.$message->category.'---'.$message->message][$message->name][$message->channel] = 1;
        }

        return $log;
    }
}
