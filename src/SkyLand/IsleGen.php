<?php
#IsleGen, 1.0.0 Beta, This will be soon Replaced by SkyLand ADV Generator
#IsleGen will also be still available, since this one generates the island. may get buggy
#SkyLand will generate around 100 islands in 1 World, and wont bug at all, more info at the WIKI.
#	__   __                 _   _                 	
#	\ \ / /                | \ | |                	
#	 \ V /  ___ _ __   ___ |  \| | _____   ____ _ 	
#	 /   \ / _ \ '_ \ / _ \| . ` |/ _ \ \ / / _` |	
#	/ /^\ \  __/ | | | (_) | |\  | (_) \ V / (_| |	
#	\/   \/\___|_| |_|\___/\_| \_/\___/ \_/ \__,_|	
#                                             
#                                             Creations
namespace SkyBlockPVP/SkyLand/IsleGen;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\level\Location;
use pocketmine\block\Dirt;
use pocketmine\block\Sand;
use pocketmine\block\Grass;
use pocketmine\block\Wood;
use pocketmine\level\generator\object\Tree;
use pocketmine\tile\Tile;
use pocketmine\tile\Chest;
use pocketmine\block\Sapling;
use pocketmine\utils\Random;


class IsleGen {
	
	//Reprecated Stuff??
	private $plugin;
	public function __construct(BasePlugin $plugin) {
		$this->plugin = $plugin;
	}
	public function getPlugin() {
		return $this->plugin;
	}
	// IDK, but if this is not needed, Plz delete
	
	public function makeIsland($name){
		$player = $this->getServer()->getPlayer($name);
        $lang = $this->getConfig()->get('Lang');
		$msgplymadeisland = $this->getResource("messages_".$lang.".yml")->get('msg_playermadeisland');
		$msgerrorplrnotfnd = $this->getResource("messages_".$lang.".yml")->get('msg_universalerrorplayernotfound');
		if(!($player instanceof Player)){
			return TextFormat::RED."[Skyblock] ".$msgerrorplrnotfnd;
		}else{
			// Make a file for the island
			$playerconform = $this->getConfig()->get('PlayerFileFormat');
			@mkdir($this->getDataFolder()."Islands/".$player.".".$playerconform);
			$height = $this->getConfig()
			$level = new Config($this->getDataFolder()."Islands/".$name.".",$playerconform, Config::ENUM);
			$level->set("location", $level.",".$x.",".$height.",".$z); #Setting for custom Height
			$level->setAll($level->getAll());
			$level->save();
			$pos = explode(",", $level->get("location"));
			$level = $pos[0];
			$x = $pos[1];
			$y = $pos[2];
			$z = $pos[3];
			$wlevel = $this->getServer()->getLevelByName($level);
			// Top layer of the island
			// 1st side
			$level->setBlock(new Position($x, $y, $z, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+6, $y, $z+6, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+6, $y, $z+5, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+6, $y, $z+4, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+6, $y, $z+3, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+6, $y, $z+2, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+6, $y, $z+1, $level), Block::get(Block::GRASS));
			// 2nd side
			$level->setBlock(new Position($x+5, $y, $z+6, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+5, $y, $z+5, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+5, $y, $z+4, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+5, $y, $z+3, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+5, $y, $z+2, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+5, $y, $z+1, $level), Block::get(Block::GRASS));
			// 3rd side
			$level->setBlock(new Position($x+4, $y, $z+6, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+4, $y, $z+5, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+4, $y, $z+4, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+4, $y, $z+3, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+4, $y, $z+2, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+4, $y, $z+1, $level), Block::get(Block::GRASS));
			// 4th side
			$level->setBlock(new Position($x+3, $y, $z+6, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+3, $y, $z+5, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+3, $y, $z+4, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+3, $y, $z+3, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+3, $y, $z+2, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+3, $y, $z+1, $level), Block::get(Block::GRASS));
			// 5th side
			$level->setBlock(new Position($x+2, $y, $z+6, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+2, $y, $z+5, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+2, $y, $z+4, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+2, $y, $z+3, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+2, $y, $z+2, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+2, $y, $z+1, $level), Block::get(Block::GRASS));
			// 6th side
			$level->setBlock(new Position($x+1, $y, $z+6, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+1, $y, $z+5, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+1, $y, $z+4, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+1, $y, $z+3, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+1, $y, $z+2, $level), Block::get(Block::GRASS));
			$level->setBlock(new Position($x+1, $y, $z+1, $level), Block::get(Block::GRASS));
			// Middle layer of the island
			// 1st Side
			$level->setBlock(new Position($x+6, $y-1, $z+6, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+6, $y-1, $z+5, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+6, $y-1, $z+4, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+6, $y-1, $z+3, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+6, $y-1, $z+2, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+6, $y-1, $z+1, $level), Block::get(Block::SAND));
			// 2nd side
			$level->setBlock(new Position($x+5, $y-1, $z+6, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+5, $y-1, $z+5, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+5, $y-1, $z+4, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+5, $y-1, $z+3, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+5, $y-1, $z+2, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+5, $y-1, $z+1, $level), Block::get(Block::SAND));
			// 3rd side
			$level->setBlock(new Position($x+4, $y-1, $z+6, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+4, $y-1, $z+5, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+4, $y-1, $z+4, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+4, $y-1, $z+3, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+4, $y-1, $z+2, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+4, $y-1, $z+1, $level), Block::get(Block::SAND));
			// 4th side
			$level->setBlock(new Position($x+3, $y-1, $z+6, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+3, $y-1, $z+5, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+3, $y-1, $z+4, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+3, $y-1, $z+3, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+3, $y-1, $z+2, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+3, $y-1, $z+1, $level), Block::get(Block::SAND));
			// 5th side
			$level->setBlock(new Position($x+2, $y-1, $z+6, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+2, $y-1, $z+5, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+2, $y-1, $z+4, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+2, $y-1, $z+3, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+2, $y-1, $z+2, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+2, $y-1, $z+1, $level), Block::get(Block::SAND));
			// 6th side
			$level->setBlock(new Position($x+1, $y-1, $z+6, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+1, $y-1, $z+5, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+1, $y-1, $z+4, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+1, $y-1, $z+3, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+1, $y-1, $z+2, $level), Block::get(Block::SAND));
			$level->setBlock(new Position($x+1, $y-1, $z+1, $level), Block::get(Block::SAND));
			// Bottom layer of the island
			// 1st side
			$level->setBlock(new Position($x+6, $y-1, $z+6, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+6, $y-1, $z+5, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+6, $y-1, $z+4, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+6, $y-1, $z+3, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+6, $y-1, $z+2, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+6, $y-1, $z+1, $level), Block::get(Block::DIRT));
			// 2nd side
			$level->setBlock(new Position($x+5, $y-1, $z+6, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+5, $y-1, $z+5, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+5, $y-1, $z+4, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+5, $y-1, $z+3, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+5, $y-1, $z+2, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+5, $y-1, $z+1, $level), Block::get(Block::DIRT));
			// 3rd side
			$level->setBlock(new Position($x+4, $y-1, $z+6, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+4, $y-1, $z+5, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+4, $y-1, $z+4, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+4, $y-1, $z+3, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+4, $y-1, $z+2, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+4, $y-1, $z+1, $level), Block::get(Block::DIRT));
			// 4th side
			$level->setBlock(new Position($x+3, $y-1, $z+6, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+3, $y-1, $z+5, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+3, $y-1, $z+4, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+3, $y-1, $z+3, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+3, $y-1, $z+2, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+3, $y-1, $z+1, $level), Block::get(Block::DIRT));
			// 5th side
			$level->setBlock(new Position($x+2, $y-1, $z+6, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+2, $y-1, $z+5, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+2, $y-1, $z+4, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+2, $y-1, $z+3, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+2, $y-1, $z+2, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+2, $y-1, $z+1, $level), Block::get(Block::DIRT));
			// 6th side
			$level->setBlock(new Position($x+1, $y-1, $z+6, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+1, $y-1, $z+5, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+1, $y-1, $z+4, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+1, $y-1, $z+3, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+1, $y-1, $z+2, $level), Block::get(Block::DIRT));
			$level->setBlock(new Position($x+1, $y-1, $z+1, $level), Block::get(Block::DIRT));
			// Tree
			$type = 0;
			Tree::growTree($level, $x+6, $x+1, $x+6, new Random(mt_rand()), Sapling::OAK);
			// Teleport the player to their new island
			$player->teleport(new Position($x, $y+5, $z, $this->getServer()->getLevelByName($levelName)));
			$player->sendMessage(TextFormat::GREEN . "[Skyblock] "#msgwelcometoyourilsland);
			$player->sendMessage(TextFormat::GREEN . "[Skyblock] "#msgifyourislanddidntcreated);
			$player->sendMessage(TextFormat::GREEN . "[Skyblock] "#msguse/isdelete);
			$player->sendMessage(TextFormat::GREEN . "[Skyblock] "#msgandcreateanotherone);
								 									#Really lazy to update this, gonna take a nap...
			// Give the player a starter kit
			// String
			$player->getInventory()->addItem(Item::get(287));
			$player->getInventory()->addItem(Item::get(287));
			$player->getInventory()->addItem(Item::get(287));
			$player->getInventory()->addItem(Item::get(287));
			$player->getInventory()->addItem(Item::get(287));
			// Emerald, WAIT? WHUT? is this ACTUALLY Needed? Opening issue...
			$player->getInventory()->addItem(Item::get(388));
			$player->getInventory()->addItem(Item::get(388));
			$player->getInventory()->addItem(Item::get(388));
			$player->getInventory()->addItem(Item::get(388));
			$player->getInventory()->addItem(Item::get(388));
			// Sapling
			$player->getInventory()->addItem(Item::get(6));
			$player->getInventory()->addItem(Item::get(6));
			$player->getInventory()->addItem(Item::get(6));
			$player->getInventory()->addItem(Item::get(6));
			$player->getInventory()->addItem(Item::get(6));
			// Water
			$player->getInventory()->addItem(Item::get(8));
			$player->getInventory()->addItem(Item::get(8));
			// Lava
			$player->getInventory()->addItem(Item::get(10));
			// Seeds
			$player->getInventory()->addItem(Item::get(295));
			$player->getInventory()->addItem(Item::get(295));
			$player->getInventory()->addItem(Item::get(295));
			$player->getInventory()->addItem(Item::get(295));
			$player->getInventory()->addItem(Item::get(295));
			// Melon seeds
			$player->getInventory()->addItem(Item::get(362));
			// Cactus
			$player->getInventory()->addItem(Item::get(81));
			// Iron Also this, do we need it?
			$player->getInventory()->addItem(Item::get(265));
			$player->getInventory()->addItem(Item::get(265));
			$player->getInventory()->addItem(Item::get(265));
			$player->getInventory()->addItem(Item::get(265));
			$player->getInventory()->addItem(Item::get(265));
			$player->getInventory()->addItem(Item::get(265));
			// Chest
			$player->getInventory()->addItem(Item::get(54));
			$this->getLogger()->info(TextFormat::BLUE."[Skyblock] ".$name . TextFormat::YELLOW . $msgplyrmadeisland);
		}
	}

}
	
?>
