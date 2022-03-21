<?php
require_once __DIR__.'/../vendor/autoload.php';
use Telegram\Bot\Commands\HelpCommand;
use Covid_Statistics_Bot\App\CustomCommands\StartCommand;
use Covid_Statistics_Bot\App\CustomCommands\OfficialChannelsCommand;
use Telegram\Bot\Exceptions\TelegramSDKException;

$apiKey = "";

try {
    $telegram = new \Telegram\Bot\Api($apiKey);
} catch (TelegramSDKException $e) {
    die($e->getMessage());
}

//available commands
$commands=[
    StartCommand::class,
    OfficialChannelsCommand::class,
    HelpCommand::class
];
//enable commands
$commandHandler=$telegram->commandsHandler(true);
//add command to command bus
$telegram->addCommands($commands);
$update=$telegram->getWebhookUpdates();
$updateId=!empty($update->getUpdateId())?$update->getUpdateId():null;

//if there is no update:exit
if($updateId==null){
    print_r(array("message"=>"Not update found"));
    die();
}
$message=$update->getMessage();
$text=$message->getText();
$chat=$message->getChat();
$chatId=$chat->getId();
$firstName=$chat->getFirstName();

//if the message is command:handle command
if(starts_with($text,"/")){
    $response=$telegram->getCommandBus()->execute(substr($text,1),array("name"=>$message->getChat()->getFirstName()),$commandHandler);
    return;
}

//capitalize country name
$text=strtoupper($text);
$api=new \Covid_Statistics_Bot\App\Api($text);
$stat=$api->getStat();
if($stat==null){
    $telegram->sendMessage([
        "chat_id"=>$chatId,
        "text"=>"No statistics found for ".$text
    ]);
    return;
}
//send info to user
$telegram->sendMessage([
    "chat_id"=>$chatId,
    "text"=>getReply($stat,$text),
    "parse_mode"=>"html"
]);
function getReply($stat,$text){
    $datetime=explode("T",$stat["time"]);
    $date=$datetime[0];
    $time=explode("+",$datetime[1])[0];
    $reply="Covid info for <strong>{$text}</strong> are as follows
New Cases: <strong>".($stat["cases"]["new"]!=null?$stat["cases"]["new"]:0)."</strong>
Active Cases: <strong>".($stat["cases"]["active"]!=null?$stat["cases"]["active"]:0)."</strong>
Critical Cases: <strong>".($stat["cases"]["critical"]!=null?$stat["cases"]["critical"]:0)."</strong>
Recovered Cases: <strong>".($stat["cases"]["recovered"]!=null?$stat["cases"]["recovered"]:0)."</strong>
New Deaths: <strong>".($stat["deaths"]["new"]!=null?$stat["deaths"]["new"]:0)."</strong>
Total Tests: <strong>".($stat["tests"]["total"]!=null?$stat["tests"]["total"]:0)."</strong>
This info was last updated at <strong>{$date} {$time}</strong>";
    return $reply;
}
