<?php

  /**
██ ██   ██  █████  ███    ███ ██ ██████   ██████  ██████  ███    ███     
██  ██ ██  ██   ██ ████  ████ ██ ██   ██ ██      ██    ██ ████  ████     
██   ███   ███████ ██ ████ ██ ██ ██████  ██      ██    ██ ██ ████ ██     
██  ██ ██  ██   ██ ██  ██  ██ ██ ██   ██ ██      ██    ██ ██  ██  ██     
██ ██   ██ ██   ██ ██      ██ ██ ██   ██  ██████  ██████  ██      ██ on GitHub : https://github.com/ixAmirCom
*/

define('API_KEY', 'token'); // Bot token

if (!is_file('ixAmir.look'))
{
  $set = bot('setwebhook', ['url' => 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'allowed_updates' => ['message', 'chat_join_request']]);
    if ($set->ok == true)
    {
        echo '<h1 style="text-align: center;margin-top:30px">The Bot Ran Successfully. | ربات با موفقیت اجرا شد.</h1>';
        @file_put_contents('ixAmir.look', '');
    }    
      else
        echo '<h1 style="text-align: center;margin-top:30px">Error in setwebhook. The Bot Token May be Wrong. | خطا در ست وبهوک. ممکن است توکن ربات اشتباه باشد</h1>';
}

function bot($method,$datas=[]) 
{
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => 'https://api.telegram.org/bot' . API_KEY . '/' . $method,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $datas
    ));
    return json_decode(curl_exec($ch));
}

$update = json_decode(file_get_contents('php://input'));
$chat_join_request = $update->chat_join_request;

if (isset($chat_join_request))
{
    bot('approveChatJoinRequest', ['chat_id' => $chat_join_request->chat->id, 'user_id' => $chat_join_request->from->id]);
    bot('sendMessage', ['chat_id' => $chat_join_request->from->id, 'text' => '┈┅━━━━┅┈🇮🇷┈┅━━━━┅┈

    - درخواست عضویت شما در چنل قبول شد.
    
    ┈┅━━━━┅┈🏴󠁧󠁢󠁥󠁮󠁧󠁿 🇺🇸┈┅━━━━┅┈
    
    - Your Request To Join The Channel Has Been Accepted.    ']); // BOT TEXT
}

?>
