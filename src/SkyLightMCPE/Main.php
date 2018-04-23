<?php
declare(strict_types=1);

namespace SkyLightMCPE;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase{

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
        if(strtolower($cmd->getName()) !== "wild") return false;
        if(!$sender instanceof Player){
            $sender->sendMessage("Use this command in game.");
            return false;
        }
        if(!$sender->hasPermission("wild.command")){
            $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
            return false;
        }
        $x = mt_rand(-256, 256);
        $z = mt_rand(-256, 256);
        $sender->getLevel()->loadChunk($x, $z, true);
        $sender->teleport(new Vector3($x, $sender->getLevel()->getHighestBlockAt($x, $z) + 2, $z));
        $sender->sendMessage(TextFormat::RED . "Teleporting...");
        return true;
    }
}
