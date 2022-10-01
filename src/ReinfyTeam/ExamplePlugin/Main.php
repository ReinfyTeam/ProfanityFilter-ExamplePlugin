<?php

namespace ReinfyTeam\ExamplePlugin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerChatEvent;
use ReinfyTeam\libpf\libpf;

class Main extends PluginBase implements Listener{
    
    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->notice("Sucessfully enabled the ProfanityFilter ExamplePlugin Testing!");
    }
    
    public function onChat(PlayerChatEvent $event) : void{
        if(libpf::detectProfanity($event->getMessage(), libpf::defaultProfanity())){
            $event->cancel(); // cancel the event
            $event->getPlayer()->sendMessage(TextFormat::RED . "Please watch your language!");
        } else {
            $event->setMessage(libpf::removeUnicode(libpf::removeProfanity($event->getMessage()), true)); // remove profanity + remove unicodes (bypasses)
        }
    }
}
