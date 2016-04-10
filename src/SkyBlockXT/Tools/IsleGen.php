<?php

namespace SkyBlockXT/Tools; // SkyGridRex, check if this is wrong!

use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\level\Location;
use pocketmine\math\Vector3; // Soon to be Removed (on this plugin :D)
use pocketmine\utils\Random; // Is this Needed?]


	public function makeIsland($name){ //Soon to be changed!
		$player = $this->getServer()->getPlayer($name);
		if(!($player instanceof Player)){
			return "Error: Player not found";
		}else{
			
			// Make a file for the island
			$islandFile = fopen($this->getDataFolder()."Islands/".$name.".txt", "w");
			fwrite($islandFile, $x.", ".$Y.", ".$z);
			$playerFile = fopen($this->getDataFolder()."Players/".$name.".txt", "w");
			fwrite($playerFile, $player->getLevel()->getName());
			
			// Top layer of the island
			// Callers:
			//$x = rand(1, 800);
			//$z = rand(1, 800);
			$minY = $this->getConfig("MinimumY");
			$z = 100;
			$x = 100;
			$Y = $minY;
			$id= 2;
			$idsand = 12;
			$iddirt = 3;
			$idwood = 17;
			$idleaves = 18;
			$idChest = 54;
			$sender = $this->getServer()->getPlayer($name)
			// End of Callers>
			
			// 1st side
			$sender->getLevel()->setBlockIdAt($x, $Y, $z, $id);
			$sender->getLevel()->setBlockIdAt($x+6, $Y, $z+6, $id);
			$sender->getLevel()->setBlockIdAt($x+6, $Y, $z+5, $id);
			$sender->getLevel()->setBlockIdAt($x+6, $Y, $z+4, $id);
			$sender->getLevel()->setBlockIdAt($x+6, $Y, $z+3, $id);
			$sender->getLevel()->setBlockIdAt($x+6, $Y, $z+2, $id);
			$sender->getLevel()->setBlockIdAt($x+6, $Y, $z+1, $id);
			
			// 2nd side
			$sender->getLevel()->setBlockIdAt($x+5, $Y, $z+6, $id);
			$sender->getLevel()->setBlockIdAt($x+5, $Y, $z+5, $id);
			$sender->getLevel()->setBlockIdAt($x+5, $Y, $z+4, $id);
			$sender->getLevel()->setBlockIdAt($x+5, $Y, $z+3, $id);
			$sender->getLevel()->setBlockIdAt($x+5, $Y, $z+2, $id);
			$sender->getLevel()->setBlockIdAt($x+5, $Y, $z+1, $id);
			
			// 3rd side
			$sender->getLevel()->setBlockIdAt($x+4, $Y, $z+6, $id);
			$sender->getLevel()->setBlockIdAt($x+4, $Y, $z+5, $id);
			$sender->getLevel()->setBlockIdAt($x+4, $Y, $z+4, $id);
			$sender->getLevel()->setBlockIdAt($x+4, $Y, $z+3, $id);
			$sender->getLevel()->setBlockIdAt($x+4, $Y, $z+2, $id);
			$sender->getLevel()->setBlockIdAt($x+4, $Y, $z+1, $id);
			
			// 4th side
			$sender->getLevel()->setBlockIdAt($x+3, $Y, $z+6, $id);
			$sender->getLevel()->setBlockIdAt($x+3, $Y, $z+5, $id);
			$sender->getLevel()->setBlockIdAt($x+3, $Y, $z+4, $id);
			$sender->getLevel()->setBlockIdAt($x+3, $Y, $z+3, $id);
			$sender->getLevel()->setBlockIdAt($x+3, $Y, $z+2, $id);
			$sender->getLevel()->setBlockIdAt($x+3, $Y, $z+1, $id);
			
			// 5th side
			$sender->getLevel()->setBlockIdAt($x+2, $Y, $z+6, $id);
			$sender->getLevel()->setBlockIdAt($x+2, $Y, $z+5, $id);
			$sender->getLevel()->setBlockIdAt($x+2, $Y, $z+4, $id);
			$sender->getLevel()->setBlockIdAt($x+2, $Y, $z+3, $id);
			$sender->getLevel()->setBlockIdAt($x+2, $Y, $z+2, $id);
			$sender->getLevel()->setBlockIdAt($x+2, $Y, $z+1, $id);
			
			// 6th side
			$sender->getLevel()->setBlockIdAt($x+1, $Y, $z+6, $id);
			$sender->getLevel()->setBlockIdAt($x+1, $Y, $z+5, $id);
			$sender->getLevel()->setBlockIdAt($x+1, $Y, $z+4, $id);
			$sender->getLevel()->setBlockIdAt($x+1, $Y, $z+3, $id);
			$sender->getLevel()->setBlockIdAt($x+1, $Y, $z+2, $id);
			$sender->getLevel()->setBlockIdAt($x+1, $Y, $z+1, $id);
			
			// Middle layer of the island
			
			// 1st side
			$sender->getLevel()->setBlockIdAt($x, $Y-1, $z, $idsand);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-1, $z+6, $idsand);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-1, $z+5, $idsand);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-1, $z+4, $idsand);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-1, $z+3, $idsand);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-1, $z+2, $idsand);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-1, $z+1, $idsand);
			
			// 2nd side
			$sender->getLevel()->setBlockIdAt($x+5, $Y-1, $z+6, $idsand);
			$sender->getLevel()->setBlockIdAt($x+5, $Y-1, $z+5, $idsand);
			$sender->getLevel()->setBlockIdAt($x+5, $Y-1, $z+4, $idsand);
			$sender->getLevel()->setBlockIdAt($x+5, $Y-1, $z+3, $idsand);
			$sender->getLevel()->setBlockIdAt($x+5, $Y-1, $z+2, $idsand);
			$sender->getLevel()->setBlockIdAt($x+5, $Y-1, $z+1, $idsand);
			
			// 3rd side
			$sender->getLevel()->setBlockIdAt($x+4, $Y-1, $z+6, $idsand);
			$sender->getLevel()->setBlockIdAt($x+4, $Y-1, $z+5, $idsand);
			$sender->getLevel()->setBlockIdAt($x+4, $Y-1, $z+4, $idsand);
			$sender->getLevel()->setBlockIdAt($x+4, $Y-1, $z+3, $idsand);
			$sender->getLevel()->setBlockIdAt($x+4, $Y-1, $z+2, $idsand);
			$sender->getLevel()->setBlockIdAt($x+4, $Y-1, $z+1, $idsand);
			
			// 4th side
			$sender->getLevel()->setBlockIdAt($x+3, $Y-1, $z+6, $idsand);
			$sender->getLevel()->setBlockIdAt($x+3, $Y-1, $z+5, $idsand);
			$sender->getLevel()->setBlockIdAt($x+3, $Y-1, $z+4, $idsand);
			$sender->getLevel()->setBlockIdAt($x+3, $Y-1, $z+3, $idsand);
			$sender->getLevel()->setBlockIdAt($x+3, $Y-1, $z+2, $idsand);
			$sender->getLevel()->setBlockIdAt($x+3, $Y-1, $z+1, $idsand);
			
			// 5th side
			$sender->getLevel()->setBlockIdAt($x+2, $Y-1, $z+6, $idsand);
			$sender->getLevel()->setBlockIdAt($x+2, $Y-1, $z+5, $idsand);
			$sender->getLevel()->setBlockIdAt($x+2, $Y-1, $z+4, $idsand);
			$sender->getLevel()->setBlockIdAt($x+2, $Y-1, $z+3, $idsand);
			$sender->getLevel()->setBlockIdAt($x+2, $Y-1, $z+2, $idsand);
			$sender->getLevel()->setBlockIdAt($x+2, $Y-1, $z+1, $idsand);
			
			// 6th side
			$sender->getLevel()->setBlockIdAt($x+1, $Y-1, $z+6, $idsand);
			$sender->getLevel()->setBlockIdAt($x+1, $Y-1, $z+5, $idsand);
			$sender->getLevel()->setBlockIdAt($x+1, $Y-1, $z+4, $idsand);
			$sender->getLevel()->setBlockIdAt($x+1, $Y-1, $z+3, $idsand);
			$sender->getLevel()->setBlockIdAt($x+1, $Y-1, $z+2, $idsand);
			$sender->getLevel()->setBlockIdAt($x+1, $Y-1, $z+1, $idsand);
			
			
			
			// Bottom layer of the island
			
			// 1st side
			$sender->getLevel()->setBlockIdAt($x, $Y-2, $z, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-2, $z+6, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-2, $z+5, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-2, $z+4, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-2, $z+3, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-2, $z+2, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+6, $Y-2, $z+1, $iddirt);
			
			// 2nd side
			$sender->getLevel()->setBlockIdAt($x+5, $Y-2, $z+6, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+5, $Y-2, $z+5, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+5, $Y-2, $z+4, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+5, $Y-2, $z+3, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+5, $Y-2, $z+2, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+5, $Y-2, $z+1, $iddirt);
			
			// 3rd side
			$sender->getLevel()->setBlockIdAt($x+4, $Y-2, $z+6, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+4, $Y-2, $z+5, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+4, $Y-2, $z+4, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+4, $Y-2, $z+3, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+4, $Y-2, $z+2, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+4, $Y-2, $z+1, $iddirt);
			
			// 4th side
			$sender->getLevel()->setBlockIdAt($x+3, $Y-2, $z+6, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+3, $Y-2, $z+5, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+3, $Y-2, $z+4, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+3, $Y-2, $z+3, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+3, $Y-2, $z+2, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+3, $Y-2, $z+1, $iddirt);
			
			// 5th side
			$sender->getLevel()->setBlockIdAt($x+2, $Y-2, $z+6, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+2, $Y-2, $z+5, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+2, $Y-2, $z+4, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+2, $Y-2, $z+3, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+2, $Y-2, $z+2, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+2, $Y-2, $z+1, $iddirt);
			
			// 6th side
			$sender->getLevel()->setBlockIdAt($x+1, $Y-2, $z+6, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+1, $Y-2, $z+5, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+1, $Y-2, $z+4, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+1, $Y-2, $z+3, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+1, $Y-2, $z+2, $iddirt);
			$sender->getLevel()->setBlockIdAt($x+1, $Y-2, $z+1, $iddirt);
			
			
			// Teleport the player to their new island
			$player->teleport(new Position($x, $Y+5, $z, $this->getServer()->getLevelByName($levelName)));
			$player->sendMessage(TextFormat::GREEN . "Welcome to your new island");
			$player->sendMessage(TextFormat::GREEN . "If your island didn't spawn,");
			$player->sendMessage(TextFormat::GREEN . "Use /is delete");
			$player->sendMessage(TextFormat::GREEN . "Then make a new island");
			
			// Give the player a starter kit
			
			// SkyGridRex: Add chest code and items, if you can, find the
			// Skyblock items that are placed on a chest,
			$sender->getLevel()->setBlockIdAt($x+6, $Y, $z+3, $idChest); //Sets Chest block.
			$this->getLogger()->info($name . TextFormat::YELLOW . " made an island! [TKRT]");
		}
	}
