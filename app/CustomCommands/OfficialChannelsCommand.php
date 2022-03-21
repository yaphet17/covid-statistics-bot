<?php

namespace Covid_Statistics_Bot\App\CustomCommands;
use Telegram\Bot\Commands\Command;

class OfficialChannelsCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name="official_channels";
    /**
     * @var string Command Description
     */
    protected $description="Official_Channels Command, Provides link to official Telegram channles of health ministries around the wolrd";

    /**
     * @inheritDoc
     */
    public function handle($arguments)
    {
        $text= "If you're looking for official news about the Novel Coronavirus and COVID-19, here are some examples of verified Telegram channels from <a href='https://telegram.org/blog/coronavirus'>health ministries</a> around the world.
        🇨🇺 <a href='https://t.me/MINSAPCuba'>Cuba</a>
        🇬🇪 <a href='https://t.me/StopCoVge'>Georgia</a>
        🇩🇪 <a href='https://t.me/Corona_Infokanal_BMG'>Germany</a>
        🇭🇰 <a href='http://t.me/HKFIGHTCOVID19'>Hong Kong</a>
        🇮🇳 <a href='https://t.me/MyGovCoronaNewsdesk'>India</a>
        🇮🇹 <a href='https://t.me/MinisteroSalute'>Italy</a>
        🇮🇱 <a href='https://t.me/MOHreport' >Israel</a>
        🇰🇿 <a href='https://t.me/coronavirus2020_kz'>Kazakhstan</a>
        🇰🇬 <a href='https://t.me/RshKRCOV'>Kyrgyzstan</a>
        🇲🇾 <a href='https://t.me/cprckkm'>Malaysia</a>
        🇲🇻 <a href='https://t.me/hpamv'>Maldives</a>
        🇳🇬 <a href='http://t.me/ncdcgov'>Nigeria</a>
        🇷🇺 <a href='https://t.me/stopcoronavirusrussia'>Russia</a>
        🇸🇦 <a href='https://t.me/LiveWellMOH'>Saudi Arabia</a>
        🇸🇬 <a href='https://t.me/govsg'>Singapore</a>
        🇪🇸 <a href='https://t.me/sanidadgob'>Spain</a>
        🇹🇬 <a href='http://t.me/GouvTG'>Togo</a>
        🇺🇦 <a href='https://t.me/COVID19_Ukraine'>Ukraine</a>
        🇺🇿 <a href='https://t.me/koronavirusinfouz'>Uzbekistan</a>";

        $this->replyWithMessage([
            "text"=>$text,
            "parse_mode"=>"html"
        ]);
    }
}