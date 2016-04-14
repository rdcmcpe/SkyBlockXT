<?php

namespace SkyBlockXT;

use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\level\Location;
use pocketmine\plugin\PluginBase as Base;
use pocketmine\math\Vector3;
use pocketmine\utils\Random;
use SkyBlockXT\utils\SkyGen; // Now secondary generator, idk how it works :L
use SkyBlockXT\Tools\SkyLand;



//WIP:

//use SkyBlockXT\Tools\;

//use SkyBlockXT\Tools\AntiTroll;

class Main extends Base implements Listener{
	public function onEnable(){
		$this->getLogger()->info(TextFormat::GREEN . "Obtaining Lang files...");
		// TEMPORAL MULTILANGUAGE SUPPORT
		$MLang = $this->getFile("Lang-" . $defLang . ".yml");
		$msg_pluginloaded = $Mlang->getLine("Load_PluginLoaded"); // Will this work? Debugging it on Popper!
		// TEMPORAL MULTILANGUAGE SUPPORT
		
		// File/Folder Creation - Soon to Change the way it configures
		if(!(is_dir($this->getDataFolder().""))){ //would it crash? I guess not
			@mkdir($this->getDataFolder()."");
		}
		$this->saveDefaultConfig();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if(!(is_dir($this->getDataFolder()."Players/"))){
			@mkdir($this->getDataFolder()."Players/");
		}
		if(!(is_dir($this->getDataFolder()."Islands/"))){
			@mkdir($this->getDataFolder()."Islands/");
		}
		// End of File/Folder Creation
		
		$this->getLogger()->info(TextFormat::GREEN . $msg_pluginloaded);
	}
	
	public function onLoad(){
	  
	  //In here will be only be used for Plugin Functions, not Plugins data or Related like onEnabled
	  
		//custom generator
		Generator::addGenerator(SkyWorld::class, "SkyWorld"); //Main Generator
		Generator::addGenerator ( SkyWorld::class, "Skyblock" ); //Secondary Generator
	  	$this->makeIsland = new SkyLand($this);
	  	if()
	  
	}
	
	public function onDisable(){
		$this->getLogger()->info(TextFormat::RED . $msg_serverstop);
	}
	
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		if(strtolower($command->getName()) == "is"){
			if(!(isset($args[0]))){
				$sender->sendMessage(TextFormat::YELLOW . "You didn't add a subcommand");
				$sender->sendMessage(TextFormat::GREEN . "Use: " . TextFormat::RESET . "/is help");
				return true;
			}elseif(isset($args[0])){
				if($args[0] == "help"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.help")){
						if(!(isset($args[1])) or $args[1] == "1"){
							$sender->sendMessage(TextFormat::GREEN . "Showing help page 1 of 1");
							$sender->sendMessage(TextFormat::GREEN . "/is help");
							$sender->sendMessage(TextFormat::GREEN . "/is create");
							$sender->sendMessage(TextFormat::GREEN . "/is home");
							$sender->sendMessage(TextFormat::GREEN . "/is sethome");
							$sender->sendMessage(TextFormat::GREEN . "/is find (op only)");
							return true;
						}elseif($args[1] == "2"){
							$sender->sendMessage("More commands coming soon");
							return true;
						}
					}else{
						$sender->sendMessage(TextFormat::RED . "You cannot view the help menu");
						return true;
					}
				}elseif($args[0] == "create"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.create")){
						$senderIs = $this->getDataFolder()."Islands/".$sender->getName().".txt";
						if($sender->getLevel()->getName() == $this->getConfig()->get("Lobby")){
							$sender->sendMessage(TextFormat::YELLOW."You can't make an island in spawn, silly");
							return true;
							
						}else{
						  
							if(!(file_exists($senderIs))){
								$this->makeIsland($sender->getName());
								return true;
							}else{
							  
								$sender->sendMessage(TextFormat::YELLOW . "You already have an island");
								return true;
							}
						}
						
					}else{
						$sender->sendMessage(TextFormat::RED . "You cannot create an island");
						return true;
					}
					
				}elseif($args[0] == "home"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.home")){
						if(!(file_exists($this->getDataFolder()."Islands/".$sender->getName().".txt"))){
							$sender->sendMessage("You don't have an island. Use /is create to make one");
							return true;
						}else{
						  
							$level = $this->getServer()->getLevelByName(yaml_parse_file($this->getDataFolder()."Players/".$sender->getName().".txt"));
							if($level !== null){
								$sender->sendMessage(TextFormat::GREEN."Teleporting to your island...");
								if($sender->getLevel()->getName() !== $level->getName()){
									$sender->sendMessage("You are not in the same world as your island. Use ".TextFormat::YELLOW."/mw tp ".$level->getName().TextFormat::RESET." and try again");
									return true;
								}else{
									$sender->teleport(new Vector3(yaml_parse_file($this->getDataFolder()."Islands/".$sender->getName().".txt")));
									$sender->sendMessage(TextFormat::GREEN."Done!");
									return true;
								}
								
							}else{
								$sender->sendMessage(TextFormat::RED . "An error has occored.");
								return true;
							}
						}
						
					}else{
						$sender->sendMessage(TextFormat::RED . "You do not have permission to do that");
						return true;
					}
				}elseif($args[0] == "delete"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.delete")){
						if(!(isset($args[1]))){
							$sender->sendMessage("Are you sure? Use /is delete yes to confirm");
							return true;
						}elseif($args[1] == "yes"){
								if(file_exists($this->getDataFolder()."Islands/".$sender->getName().".txt")){
									unlink($this->getDataFolder()."Islands/".$sender->getName().".txt");
									$sender->sendMessage("Your island has been deleted");
									return true;
								}else{
									$sender->sendMessage("You don't have an island");
									return true;
								}
							}elseif($args[1] == "no"){
								$sender->sendMessage("Okay, we won't delete your island");
								return true;
							}else{
								return false;
							}
						}else{
							$sender->sendMessage("You cannot delete your island");
							return true;
						}
						
					}elseif($args[0] == "sethome"){
						if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.sethome")){
							if(!(isset($args[1]))){
								$sender->sendMessage("Are you sure? Make sure you are on your island");
								$sender->sendMessage("Your island will be lost if you're not on your island. Do /is sethome yes to confirm");
								return true;
							}elseif($args[1] == "yes"){
								if(file_exists($this->getDataFolder()."Islands/".$sender->getName().".txt")){
									$sender->sendMessage("Setting your home...");
									$file = $this->getDataFolder()."Islands/".$sender->getName().".txt";
									unlink($file);
									$newFile = fopen($file, "w");
									fwrite($newFile, $sender->x.", ".$sender->y.", ".$sender->z);;
									$sender->sendMessage("Set your home.");
									return true;
								}else{
									$sender->sendMessage("You don't have an island");
									return true;
								}
							}elseif($args[1] == "no"){
								$sender->sendMessage("Okay, we won't set your home");
								return true;
							}else{
								$sender->sendMessage("Unknown subcommand: ".$args[1]);
								$sender->sendMessage("/sethome <yes | no>");
								return true;
							}
						}else{
							$sender->sendMessage("You don't have permission to set your home");
							return true;
						}
					}
				}
			}
		}

	
	// When a player joins
	public function onPlayerJoinEvent(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		if(file_exists($this->getDataFolder()."Players/".$player->getName().".txt")){
			$player->sendMessage("Welcome back, " . $player->getName());
		}else{
			$this->getServer()->broadcastMessage(TextFormat::GREEN . "Welcome ".TextFormat::RESET.$player->getName().TextFormat::GREEN." to the server");
			$file = fopen($this->getDataFolder()."Players/".$player->getName().".txt", "w");
			fclose($file);
		}
	}
}
