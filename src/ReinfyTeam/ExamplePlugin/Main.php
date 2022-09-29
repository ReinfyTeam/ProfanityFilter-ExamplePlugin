<?php

namespace ReinfyTeam\ExamplePlugin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerChatEvent;
use ReinfyTeam\libpf\ProfanityFilter;

class Main extends PluginBase implements Listener{
    
    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->notice("Sucessfully enabled the ProfanityFilter ExamplePlugin Testing!");
    }
    
    public function onChat(PlayerChatEvent $event) : void{
        if(ProfanityFilter::detectProfanity($event->getMessage(), ProfanityFilter::defaultProfanity())){
            $event->cancel(); // cancel the event
            $event->getPlayer()->sendMessage(TextFormat::RED . "Please watch your language!");
        } else {
            $event->setMessage(ProfanityFilter::removeUnicode(ProfanityFilter::removeProfanity($event->getMessage()), true)); // remove profanity + remove unicodes (bypasses)
        }
    }
}