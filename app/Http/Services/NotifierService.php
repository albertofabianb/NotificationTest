<?php
namespace App\Http\Services;

use App\Models\UserChannel;
use App\Models\UserMessage;
use App\Models\UserMessageChannel;
use App\Models\UserCategory;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class NotifierService
{
    const SMS = 1;
    const EMAIL = 2;
    const PUSH_NOTIFICATION = 3;

    public function publish($category_id, $message_text)
    {
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

                    $user = User::find($user_category->user_id);
                    $channelService = $this->channelSelector($user_channel->channel_id);
                      /**** HERE IS THE NOTIFICATION SENDING ****/
                    $sent_ok = $this->send($message, $user, $channelService);
                    /*****************************************/
echo "$sent_ok ";
                    $user_message_channel = new UserMessageChannel();
                    $user_message_channel->channel_id = $user_channel->channel_id;
                    $user_message_channel->user_message_id = $user_message->id;
                    $user_message_channel->sent_ok = $sent_ok;
                    $user_message_channel->save();
                }
            }

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
    }

    public function send(Message $message, User $user, ChannelServiceInterface $channelServiceInterface): bool {
        return $channelServiceInterface->send($message, $user);
    }

    public function channelSelector($channel_id): ChannelServiceInterface
    {
        switch ($channel_id) {
            case self::SMS: return new SmsChannelService();
            case self::EMAIL: return new EmailChannelService();
            case self::PUSH_NOTIFICATION: return new PushNotificationChannelService();
        }
        return null;
    }
}