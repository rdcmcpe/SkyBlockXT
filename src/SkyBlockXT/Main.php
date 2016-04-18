<?php

namespace SkyBlockXT;

use pocketmine\level\generator\Generator;
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
use pocketmine\Server
use SkyBlockXT\utils\SkyBlockGenerator; // Now secondary generator, idk how it works :L
use SkyBlockXT\Tools\SkyLand;
use SkyBlockXT\Tools\SkyWorld;



//WIP:

//use SkyBlockXT\Tools\;

//use SkyBlockXT\Tools\AntiTroll;

class Main extends Base implements Listener{
	public function onEnable(){
		
		$this->saveDefaultConfig();
		$this->getLogger()->info(TextFormat::AQUA . "Saving/Creating/Loading Configuration files");
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
		$this->getLogger()->info(TextFormat::AQUA . "Done!");
		
		// End of File/Folder Creation
		
		$this->getLogger()->info(TextFormat::YELLOW . "New Task:");
		$this->getLogger()->info(TextFormat::GREEN . "Obtaining languages files...");
		
		// TEMPORAL MULTILANGUAGE SUPPORT
		$defLang = $this->getConfig()->get('Language');
        	if(!(is_dir($this->getDataFolder()."Lang-".$defLang.".yml"))){
			$this->plugin->saveResource("Lang-".$defLang.".yml", true);
		 }else{
			 
		 }
		$MLang = $this->getResource("Lang-" . $defLang . ".yml");
		$info_pluginloaded = $Mlang->get("INFO_PluginLoaded"); // Will this work? Debugging it on Popper!
		$info_pluginserverstop = $Mlang->get("INFO_ServerStopped"); // Will this work? Debugging it on Popper!
		$help_showlist = $Mlang->get("HELP_ShowList");
		$help_morecmdsoon = $Mlang->get("HELP_MoreCMDSoon");
		
		
		// TEMPORAL MULTILANGUAGE SUPPORT
		
		$this->getLogger()->info(TextFormat::BLUE . $msg_pluginloaded);
	}
	
	public function onLoad(){
		// Registering Key SkyLock 32b [Going to be used for stats and backups!]
		$UUID_Data = $this->getConfig()->get("Language") + $this->getConfig()->get("IslandPerWorld") + $this->getServerName();
		$hash = crypt($UUID_Data);
		$this->getLogger()->info(TextFormat::GOLD . "This is your UUID from SkyblockXT Plugin: ".$hash." Its useless by now and just for Debugging :P");
		//$this->getLogger()->info(TextFormat::RED . "By now its useless, but it will make a UUID for Backup systems and IsLock")
		//$this->getlogger()->info(TextFormat::RED . "So if you get hacked your players info will be backuped with a ecrypted password")
		//$this->getlogger()->info(TextFormat::RED . "This 'Feature' Will not be deactivatable until encryption changes from 32bit to 128bit!")
		
		//In here will be only be used for Plugin Functions, not Plugins data or Related like onEnabled
	  
		//custom generator
		Generator::addGenerator(SkyWorld::class, "SkyWorld"); //Main Generator - 1
		if($this->getConfig()->get('EnableDebug') == true){
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] SkyWorld Generator Added (1)");
		}
		Generator::addGenerator ( SkyWorld::class, "Skyblock" ); //Secondary Generator - 2
		if($this->getConfig()->get('EnableDebug') == true){
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] SkyBlock Generator Added (2)");
		}
	  	# Create code for: If skyworld is false then generate world with gen 1 or 2
	  	# Then Setblock on all world
	}
	
	public function onDisable(){
		$this->getLogger()->info(TextFormat::RED . $msg_serverstop);
	}
	
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		$bn = "[SkyblockXT]";
		if(strtolower($command->getName()) == "is"){
			if(!(isset($args[0]))){
				$sender->sendMessage(TextFormat::YELLOW . $bn . $gen_is_didntaddsubcmd);
				$sender->sendMessage(TextFormat::GREEN . $bn . $gen_use . TextFormat::RESET . "/is help");
				return true;
			}elseif(isset($args[0])){
				if($args[0] == "help"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.help")){
						if(!(isset($args[1])) or $args[1] == "1"){
							$sender->sendMessage(TextFormat::GREEN . $bn . $help_showlist);
							$sender->sendMessage(TextFormat::GREEN . "/is help");
							$sender->sendMessage(TextFormat::GREEN . "/is create");
							$sender->sendMessage(TextFormat::GREEN . "/is home");
							$sender->sendMessage(TextFormat::GREEN . "/is sethome");
							return true;
						}elseif($args[1] == "2"){
							$sender->sendMessage(. $bn . $help_morecmdsoon);
							return true;
						}
					}else{
						$sender->sendMessage(TextFormat::RED . $bn ."You cannot view the help menu");
						return true;
					}
				}elseif($args[0] == "create"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.create")){
						$senderIs = $this->getDataFolder()."Islands/".$sender->getName().".txt";
						if($sender->getLevel()->getName() == $this->getConfig()->get("Lobby")){
							$sender->sendMessage(TextFormat::YELLOW. $bn ."You are not allowed to generate an island here");
							return true;
							
						}else{
						  
							if(!(file_exists($senderIs))){
								echo "WIP"
								return true;
							}else{
							  
								$sender->sendMessage(TextFormat::YELLOW . $bn ."You already have an active island");
								return true;
							}
						}
						
					}else{
						$sender->sendMessage(TextFormat::RED. $bn ."You cannot create an island");
						return true;
					}
					
				}elseif($args[0] == "home"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.home")){
						if(!(file_exists($this->getDataFolder()."Islands/".$sender->getName().".txt"))){
							$sender->sendMessage(. $bn ."You don't have an island. Use /is create to make one");
							return true;
						}else{
						  
							$level = $this->getServer()->getLevelByName(yaml_parse_file($this->getDataFolder()."Players/".$sender->getName().".txt"));
							if($level !== null){
								$sender->sendMessage(TextFormat::GREEN. $bn ."Teleporting you to your island...");
								if($sender->getLevel()->getName() !== $level->getName()){
									$sender->sendMessage(. $bn ."You are not in the same world as your island. Use ".TextFormat::YELLOW."/mw tp ".$level->getName().TextFormat::RESET." and try again");
									return true;
								}else{
									$sender->teleport(new Vector3(yaml_parse_file($this->getDataFolder()."Islands/".$sender->getName().".txt")));
									$sender->sendMessage(TextFormat::GREEN. $bn ."Done!");
									return true;
								}
								
							}else{
								$sender->sendMessage(TextFormat::RED. $bn . "An error has occurred.");
								return true;
							}
						}
						
					}else{
						$sender->sendMessage(TextFormat::RED . $bn ."You do not have permission to do that");
						return true;
					}
				}elseif($args[0] == "delete"){
					if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.delete")){
						if(!(isset($args[1]))){
							$sender->sendMessage(. $bn ."Are you sure you want to do this?\nUse /is delete yes to confirm");
							return true;
						}elseif($args[1] == "yes"){
								if(file_exists($this->getDataFolder()."Islands/".$sender->getName().".txt")){
									unlink($this->getDataFolder()."Islands/".$sender->getName().".txt");
									$sender->sendMessage(. $bn ."Your island has been deleted");
									return true;
								}else{
									$sender->sendMessage(. $bn ."You don't have any islands");
									return true;
								}
							}elseif($args[1] == "no"){
								$sender->sendMessage(. $bn .. $bn ."Okay, we won't delete your island");
								return true;
							}else{
								return false;
							}
						}else{
							$sender->sendMessage(. $bn ."Island deletion has been cancelled");
							return true;
						}
						
					}elseif($args[0] == "sethome"){
						if($sender->hasPermission("is") || $sender->hasPermission("is.command") || $sender->hasPermission("is.command.sethome")){
							if(!(isset($args[1]))){
								$sender->sendMessage(. $bn ."You will be setting your home on your island, Make sure you are standing on it");
								$sender->sendMessage(. $bn ."Your island will be lost if you're not on your island. Do /is sethome yes to confirm");
								return true;
							}elseif($args[1] == "yes"){
								if(file_exists($this->getDataFolder()."Islands/".$sender->getName().".txt")){
									$sender->sendMessage("Setting your home...");
									$file = $this->getDataFolder()."Islands/".$sender->getName().".txt";
									unlink($file);
									$newFile = fopen($file, "w");
									fwrite($newFile, $sender->x.", ".$sender->y.", ".$sender->z);;
									$sender->sendMessage("Your home has been set!");
									return true;
								}else{
									$sender->sendMessage(. $bn ."You don't have any islands");
									return true;
								}
							}elseif($args[1] == "no"){
								$sender->sendMessage(. $bn ."Okay, we won't set your home");
								return true;
							}else{
								$sender->sendMessage(. $bn ."Unknown subcommand: ".$args[1]);
								$sender->sendMessage(. $bn ."/sethome <yes | no>");
								return true;
							}
						}else{
							$sender->sendMessage(. $bn ."You don't have permission to set your home");
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
			$this->getServer()->broadcastMessage(TextFormat::GREEN . $bn . "Welcome ".TextFormat::RESET.$player->getName().TextFormat::GREEN." to the server");
			$file = fopen($this->getDataFolder()."Players/".$player->getName().".txt", "w");
			fclose($file);
		}
	}
}
