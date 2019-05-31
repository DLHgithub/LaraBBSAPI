<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    public function update(User $user, Reply $reply)
    {
        // return $reply->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Reply $reply)
    {
        // 回复用户
        $isReplyUser = $user->id == $reply->user_id;
        // 话题作者
        $isTopicUser = $reply->topic->user_id == $user->id;
        // dd(['r' => $isReplyUser, 't' => $isTopicUser]);
        return $isReplyUser || $isTopicUser;
    }
}
