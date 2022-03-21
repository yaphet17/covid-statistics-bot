<?php

namespace Covid_Statistics_Bot\App\CustomCommands;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name="start";
    /**
     * @var string Command Description
     */
    protected $description="Start Command, Start interacting with the our bot";

    /**
     * @inheritDoc
     */
    public function handle($arguments)
    {
    $text="Hello ".$arguments["name"]."🖐
    \nOur bot will provide you latest information about Covid-19 form anywhere in the world.
Enter country name to get started
    \n<strong>Stay safe!</strong> 😷";
        $this->replyWithMessage([
            "text"=>$text,
            "parse_mode"=>"html"
        ]);
    }
}