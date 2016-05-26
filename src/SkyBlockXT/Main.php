<?php

namespace SkyBlockXT;

use pocketmine\level\generator\Generator;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\generator\object\Tree;
use pocketmine\block\Sapling;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\block\Dirt;
use pocketmine\block\Sand;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\level\Location;
use pocketmine\plugin\PluginBase as Base;
use pocketmine\math\Vector3;
use pocketmine\utils\Random;
use pocketmine\Server;
use SkyBlockXT\utils\SkyBlockGenerator;
use SkyBlockXT\Tools\SkyLand;
use SkyBlockXT\Tools\SkyWorld;
use SkyBlockXT\Tools\Language;
use SkyBlockXT\Tools\FileConfig;


class Main extends Base implements Listener{
	public function onEnable(){
		if(!(is_dir($this->getDataFolder()."Islands/"))){
			mkdir($this->getDataFolder()."Islands/");
		}
		$tkrt = TextFormat::AQUA . "[TKRT-SkyBlockXT]";
		$this->getLogger()->info(TextFormat::AQUA . "Loading Plugin! Please wait....". $tkrt);
		$this->FileConfigs = new FileConfig($this);
		//$this->messages = new Language($this);

		
		/* Custom Generators - THEY CRASH THE PLUGIN!! OTHER WAY ADD THEM??
		Generator::addGenerator(SkyWorld::class, "SkyWorld"); //Main Generator - 1
		if($this->getConfig()->get('EnableDebug') == true){
			$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] SkyWorld Generator Added (1)" .$tkrt);
			}
		Generator::addGenerator ( SkyBlockGenerator::class, "Skyblock" ); //Secondary Generator - 2
		if($this->getConfig()->get('EnableDebug') == true){
			$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] SkyBlock Generator Added (2)" .$tkrt);
		} */
	}
	
	public function onDisable(){
		$defLang = $this->getConfig()->get('Language');
		$langConfig = new Config($this->getDataFolder()."Lang-".$defLang.".yml", Config::YAML);
		$info_serverstop = $langConfig->get("INFO.ServerStopped"); 
		$this->getLogger()->info(TextFormat::RED . "".$info_serverstop."");
	}
	
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		$bn = "[SkyblockXT]";
		// TEMPORAL LANGUAGE SUPPORT ===================================
		$defLang = $this->getConfig()->get('Language');
		$help_showlist = $this->getResource("Lang-".$defLang.".yml")->get("HELP.ShowList");
		$help_morecmdsoon = $this->getResource("Lang-".$defLang.".yml")->get("HELP.MoreCMDSoon");
		$help_error = $this->getResource("Lang-".$defLang.".yml")->get("HELP.Error");
		$gen_error = $this->getResource("Lang-".$defLang.".yml")->get("GEN.Error");
		$gen_Permitions_error = $this->getResource("Lang-".$defLang.".yml")->get("GEN.Permitions.Errors");
		$gen_iscmd_notscmd = $this->getResource("Lang-".$defLang.".yml")->get("GEN.ISCMD.NoSubCommand");
		$gen_usehelp = $this->getResource("Lang-".$defLang.".yml")->get("GEN.Use.Help");
		$is_create_error = $this->getResource("Lang-".$defLang.".yml")->get("IS.Create.Error");
		$is_active = $this->getResource("Lang-".$defLang.".yml")->get("IS.Active");
		$is_noisland = $this->getResource("Lang-".$defLang.".yml")->get("IS.DontHaveIsland");
		$is_nopermission = $this->getResource("Lang-".$defLang.".yml")->get("IS.NoPermition");
		$is_teleporting = $this->getResource("Lang-".$defLang.".yml")->get("IS.Teleporting");
		$is_home_error = $this->getResource("Lang-".$defLang.".yml")->get("IS.Home.Error");
		$is_deleteisland = $this->getResource("Lang-".$defLang.".yml")->get("IS.DeleteIsland");
		$is_deleteisland_confirm = $this->getResource("Lang-".$defLang.".yml")->get("IS.DeleteIsland.Confirm");
		$is_deleteisland_cancel = $this->getResource("Lang-".$defLang.".yml")->get("IS.DeleteIsland.Cancel");
		$is_deleteisland_error = $this->getResource("Lang-".$defLang.".yml")->get("IS.DeleteIsland.Error");
		$is_sethome = $this->getResource("Lang-".$defLang.".yml")->get("IS.SetHome");
		$is_sethome_2 = $this->getResource("Lang-".$defLang.".yml")->get("IS.SetHome.2");
		$is_sethome_set = $this->getResource("Lang-".$defLang.".yml")->get("IS.SetHome.Set");
		$is_sethome_cancel = $this->getResource("Lang-".$defLang.".yml")->get("IS.SetHome.Cancel");
		// TEMPORAL LANGUAGE SUPPORT ===================================
		switch(strtolower($command->getName())){
			case "is":
			if(!(isset($args[0]))){
				$sender->sendMessage(TextFormat::YELLOW . $bn . $gen_is_didntaddsubcmd);
				$sender->sendMessage(TextFormat::GREEN . $bn . $gen_use . TextFormat::RESET . "/is help");
				return true;
			}elseif(isset($args[0])){
				if($args[0] == "help"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.help")){
						if(!(isset($args[1])) or $args[1] == "1"){
							$sender->sendMessage(TextFormat::GOLD . $bn . $help_showlist);
							$sender->sendMessage(TextFormat::GREEN . "/is help");
							$sender->sendMessage(TextFormat::GREEN . "/is create");
							$sender->sendMessage(TextFormat::GREEN . "/is home");
							$sender->sendMessage(TextFormat::GREEN . "/is sethome");
							return true;
						}elseif($args[1] == "2"){
							$sender->sendMessage($bn . $help_morecmdsoon);
							return true;
						}
					}else{
						$sender->sendMessage(TextFormat::RED . $bn . $help_error);
						return true;
					}
				}elseif($args[0] == "create"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.create")){
						$senderIs = $this->getDataFolder()."Islands/".$sender->getName().".yml";
						if($sender->getLevel()->getName() == $this->getConfig()->get("Lobby")){
							$sender->sendMessage(TextFormat::YELLOW . $bn . $is_create_error);
							return true;
							
						}else{
						  
							if(!(file_exists($senderIs))){
								echo "WIP";
								return true;
							}else{
							  	$this->createIsland($sender->getName());
								$sender->sendMessage(TextFormat::YELLOW . $bn . $is_active);
								return true;
							}
						}
						
					}else{
						$sender->sendMessage(TextFormat::RED . $bn . $is_nopermission);
						return true;
					}
					
				}elseif($args[0] == "home"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.home")){
						if(!(file_exists($this->getDataFolder()."Islands/".$sender->getName().".yml"))){
							$sender->sendMessage($bn . $is_noisland);
							return true;
						}else{
						  	$file = new Config($this->getDataFolder()."Islands/".$sender->getName().".yml", Config::YAML);
							$level = $this->getServer()->getLevelByName($file->get("World"));
							if($level !== null){
								$sender->sendMessage(TextFormat::GREEN . $bn . $is_teleporting);
								$x = $file->get("X");
								$y = $file->get("Y");
								$z = $file->get("Z");
								if($sender->getLevel()->getName() !== $level->getName()){
									$sender->teleport(new Position($x, $y, $z, $level));
									return true;
								}else{
									$sender->teleport(new Vector3($x, $y, $z));
									return true;
								}
								
							}else{
								$sender->sendMessage(TextFormat::RED . $bn . $gen_error);
								return true;
							}
						}
						
					}else{
						$sender->sendMessage(TextFormat::RED . $bn . $gen_Permitions_error);
						return true;
					}
				}elseif($args[0] == "delete"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.delete")){
						if(!(isset($args[1]))){
							$sender->sendMessage($bn . $is_deleteisland);
							return true;
						}elseif($args[1] == "yes"){
								if(file_exists($this->getDataFolder()."Islands/".$sender->getName().".yml")){
									unlink($this->getDataFolder()."Islands/".$sender->getName().".yml");
									$sender->sendMessage($bn . $is_deleteisland_confirm);
									return true;
								}else{
									$sender->sendMessage($bn . $is_deleteisland_error);
									return true;
								}
							}elseif($args[1] == "no"){
								$sender->sendMessage($bn . $is_deleteisland_cancel);
								return true;
							}else{
								return false;
							}
						}
						
					}elseif($args[0] == "sethome"){
						if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.sethome")){
							if(!(isset($args[1]))){
								$sender->sendMessage($bn . $is_sethome);
								$sender->sendMessage($bn . $is_sethome_2);
								return true;
							}elseif($args[1] == "yes"){
								if(file_exists($this->getDataFolder()."Islands/".$sender->getName().".yml")){
									$file = new Config($this->getDataFolder()."Islands/".$sender->getName().".yml", Config::YAML);
									$file->set("X", $sender->x);
									$file->set("Y", $sender->y);
									$file->set("Z", $sender->z);
									$file->set("World", $sender->getLevel()->getName());
									$sender->sendMessage($is_sethome_set);
									return true;
								}else{
									$sender->sendMessage($bn . $is_noisland);
									return true;
								}
							}elseif($args[1] == "no"){
								$sender->sendMessage($bn . $is_sethome_cancel);
								return true;
							}else{
								$sender->sendMessage($bn ."/sethome <yes | no>");
								return true;
							}
						}else{
							$sender->sendMessage($bn . $gen_Permitions_error);
							return true;
						}
					}
				}
				case "skyworld":
				if($sender->hasPemission("skyworld") || $sender->hasPemission("skyworld.cmd")){
					if(isset($args[0])){
						if(strtolower($args[0]) == "help"){
							// There hasn't been any multilanguage setting fo this, so i just put it in english
							// Ill later add them...
							$sender->sendMessage(TextFormat::BLUE."SkyWorld command help");
							$sender->sendMessage(TextFormat::GREEN."==================================");
							$sender->sendMessage(TextFormat::GREEN."/skyworld genworld <name>: ".TextFormat::RESET."Generate a new skyblock world");
							$sender->sendMessage(TextFormat::GREEN."/skyworld delworld <name>: ".TextFormat::RESET."Deletes a skyblock world");
							$sender->sendMessage(TextFormat::GREEN."/skyworld [help]: ".TextFormat::RESET."Shows a list of SkyWorld commands");
							$sender->sendMessage(TextFormat::GREEN."==================================");
							return true;
							// I'm sure there are more command, but i'm just putting these for now...
							// Ok!
						}else{
							if(strtolower($args[0]) == "delworld"){
								if(isset($args[1])){
									$world = $this->getServer()->getLevelByName($args[1]);
									if($world !== null){
										if(isset($args[2])){
											if(strtolower($args[2]) == "yes"){
												if(is_dir($this->getServer()->getDataPath()."worlds/".$args[1])){
													$level = $this->getServer()->getDataPath()."worlds/".$args[1];
													rmdir($level);
													return true;
												}else{
													$sender->sendMessage(TextForat::YELLOW."There is no level by that name!");
													return true;
												}
											}else{
												$sender->sendMessage(TextFormat::GREEN."Okay, we won't delete that world.");
												return true;
											}
										}else{
											$sender->sendMessage(TextFormat::YELLOW."Are you sure? This cannot be undone. Use /skyworld delworld ".$args[1]." yes to confirm.");
											return true;
										}
									}else{
										$sender->sendMessage(TextFormat::YELLOW."There is no level by that name!");
										return true;
									}
								}else{
									$sender->sendMessage(TextFormat::YELLOW."You need to specify a world!");
									return false;
								}
							}elseif($args[0] == "genworld"){
								
							}
						}
					}
				}
			}
		}

	
	// When a player joins
	public function onPlayerJoinEvent(PlayerJoinEvent $event){
		
		$player = $event->getPlayer();
		// TEMPORAL LANGUAGE SUPPORT =============================
		$defLang = $this->getConfig()->get('Language');
		$info_newplayerjoin = $this->getResource("/Lang-".$defLang.".yml")->get("INFO.NewPlayerJoined");
		$info_welcomeback = $this->getResource("/Lang-".$defLang.".yml")->get("INFO.WelcomeBackPlayer");
		// TEMPORAL LANGUAGE SUPPORT =============================
		if(file_exists($this->getDataFolder()."Players/".$player->getName().".txt")){
			$player->sendMessage($info_welcomeback. $player->getName());
		}else{
			$this->getLogger()->notice(TextFormat::GOLD . $info_newplayerjoin . $player->getName());
		}
	}
	
	// Island Generator
	public function createIsland($name){
		$player = $this->getServer()->getPlayerByName($name);
		$x = rand(0, 1000);
		$y = 100;
		$z = rand(0, 1000);
		$level = $player->getLevel();
		
		// Island config
		$isFile = new Config($this->getDataFolder()."Islands/".$player->getName().".yml", Config::YAML);
		$isFile->set("X", $x);
		$isFile->set("Y", $y);
		$isFile->set("Z", $z);
		$isFile->set("World", $player->getLevel()->getName());
		$file->save();
		
		// Make the island
		$level->setBlock(new Vector3($x, $y, $z));
		for($i = 1; $i <= 2; $i++){
			if($i == 1){
				$block = Sand();
			}else{
				$block = Dirt();
			}
			$level->setBlock(new Vector3($x, $y - $i, $z), new $block);
		}
		for($a = 1; $a <= 6; $a++){
			for($b = 1; $b <= 6; $b++){
				$level->setBlock(new Vector3($x + $a, $y, $z + $b));
			}
		}
		
		// Make a tree
		Tree::growTree($level, $x + 6, $y + 1, $z + 6, new Random(mt_rand()), Sapling::OAK);
		
		// Teleport the player to their new island
		$player->teleport(new Position($randX, $Y+5, $randZ, $this->getServer()->getLevelByName($levelName)));
		$player->sendMessage(TextFormat::GREEN . "Welcome to your new island!");
		$player->sendMessage(TextFormat::GREEN."Check your inventory for your starter kit.");
		
		// Starter Kit
		// String
		for($i = 1; $i == 5, $i++){
			$player->getInventory()->addItem(Item::get("287"));
		}
		
		// Emerald (you can delete this is you think it's not needed)
		for($i = 1; $i == 5, $i++){
			$player->getInventory()->addItem(Item::get("388"));
		}
		
		// Saplings
		for($i = 1; $i == 5, $i++){
			$player->getInventory()->addItem(Item::get("6"));
		}
		
		// Water (Not in buckets, because buckets don't work correctly on pocketmine)
		for($i = 1; $i == 2, $i++){
			$player->getInventory()->addItem(Item::get("8"));
		}
		
		// Lava
		$player->getInventory()->addItem(Item::get("10"));
		
		// Seeds
		for($i = 1; $i == 5, $i++){
			$player->getInventory()->addItem(Item::get("295"));
		}
		
		// Melon Seeds
		$player->getInventory()->addItem(Item::get("362"));
		
		// Cactus
		$player->getInventory()->addItem(Item::get("81"));
		
		// Iron
		for($i = 1; $i == 6, $i++){
			$player->getInventory()->addItem(Item::get("265"));
		}
		
		// Bones
		for($i = 1; $i == 5, $i++){
			$player->getInventory()->addItem(Item::get("352"));
		}
		
		// Chest
		$player->getInventory()->addItem(Item::get("54"));
		
		$this->getLogger()->info($player->getName().TextFormat::BLUE." made an island");
	}
}
