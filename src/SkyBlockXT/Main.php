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
use pocketmine\Server;
use SkyBlockXT\utils\SkyBlockGenerator; // Now secondary generator, idk how it works :L
use SkyBlockXT\Tools\SkyLand;
use SkyBlockXT\Tools\SkyWorld;

//WIP:

//use SkyBlockXT\Tools\;

//use SkyBlockXT\Tools\AntiTroll;

class Main extends Base implements Listener{
	public function onEnable(){
	$tkrt = TextFormat::AQUA . "[TKRT-SkyBlockXT P.A]";
	$this->getLogger()->info(TextFormat::AQUA . "Config Files Created!");
	$this->saveDefaultConfig();
	if($this->getConfig()->get('EnableDebug') == true){
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] Saved Configuration Files: " .$tkrt);
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] config.yml at SkyBlockXT Folder" .$tkrt);
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] Loading Language Files..... " .$tkrt);
	}
			
		
		// TEMPORAL MULTILANGUAGE SUPPORT ------------------------------------------------
		$defLang = $this->getConfig()->get('Language');
        if(!(is_dir($this->getDataFolder()."/Lang-".$defLang.".yml"))){
			$this->plugin->saveResource("/Lang-".$defLang.".yml"); // NEED HELP! IDK HOW TO SAVE RESOURCES!
		 }else{
			 
		 }
		$MLang = $this->getResource("Lang-" . $defLang . ".yml");
		$info_pluginloaded = $Mlang->get("INFO.PluginLoaded"); 
		$info_newplayerjoin = $Mlang->get("INFO.NewPlayerJoined");
		$info_serverstop = $Mlang->get("INFO.ServerStopped"); 
		$info_welcomeback = $MLang->get("INFO.WelcomeBackPlayer");
		$help_showlist = $Mlang->get("HELP.ShowList");
		$help_morecmdsoon = $Mlang->get("HELP.MoreCMDSoon");
		$help_error = $Mlang->get("HELP.Error");
		$gen_error = $Mlang->get("GEN.Error");
		$gen_Permitions_error = $Mlang->get("GEN.Permitions.Errors");
		$gen_iscmd_notscmd = $Mlang->get("GEN.ISCMD.NoSubCommand");
		$gen_usehelp = $Mlang->get("GEN.Use.Help");
		$is_create_error = $Mlang->get("IS.Create.Error");
		$is_active = $Mlang->get("IS.Active");
		$is_noisland = $Mlang->get("IS.DontHaveIsland");
		$is_nopermission = $Mlang->get("IS.NoPermition");
		$is_teleporting = $Mlang->get("IS.Teleporting");
		$is_home_error = $Mlang->get("IS.Home.Error");
		$is_deleteisland = $Mlang->get("IS.DeleteIsland");
		$is_deleteisland_confirm = $Mlang->get("IS.DeleteIsland.Confirm");
		$is_deleteisland_cancel = $Mlang->get("IS.DeleteIsland.Cancel");
		$is_deleteisland_error = $Mlang->get("IS.DeleteIsland.Error");
		$is_sethome = $Mlang->get("IS.SetHome");
		$is_sethome_2 = $Mlang->get("IS.SetHome.2");
		$is_sethome_set = $Mlang->get("IS.SetHome.Set");
		$is_sethome_cancel = $Mlang->get("IS.SetHome.Cancel");
		
		
		// TEMPORAL MULTILANGUAGE SUPPORT ------------------------------------------------
		
		// File/Folder Creation - Soon to Change the way it configures
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if(!(is_dir($this->getDataFolder()."Players/"))){
			@mkdir($this->getDataFolder()."Players/");
		}
		if(!(is_dir($this->getDataFolder()."Islands/"))){
			@mkdir($this->getDataFolder()."Islands/");
		}
		// End of File/Folder Creation
	
		$this->getLogger()->info(TextFormat::BLUE . $msg_pluginloaded);
				//In here will be only be used for Plugin Functions, not Plugins data or Related like onEnabled

			if($this->getConfig()->get('EnableDebug') == true){
			$UUID_Data = $this->getConfig()->get("Language") + $this->getConfig()->get("IslandPerWorld") + $this->getServerName();
			$hash = crypt($UUID_Data);
			$this->getLogger()->info(TextFormat::GOLD . "This is your UUID from SkyblockXT Plugin: ".$hash." Its useless by now and just for Debugging :P" .$tkrt);
		}

		// Custom Generators
		Generator::addGenerator(SkyWorld::class, "SkyWorld"); //Main Generator - 1
			if($this->getConfig()->get('EnableDebug') == true){
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] SkyWorld Generator Added (1)" .$tkrt);
		}
		Generator::addGenerator ( SkyBlockGenerator::class, "Skyblock" ); //Secondary Generator - 2
			if($this->getConfig()->get('EnableDebug') == true){
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] SkyBlock Generator Added (2)" .$tkrt);
		}
	}
	
	public function onDisable(){
		$this->getLogger()->info(TextFormat::RED . $info_serverstop);
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
						$senderIs = $this->getDataFolder()."Islands/".$sender->getName().".txt";
						if($sender->getLevel()->getName() == $this->getConfig()->get("Lobby")){
							$sender->sendMessage(TextFormat::YELLOW . $bn . $is_create_error);
							return true;
							
						}else{
						  
							if(!(file_exists($senderIs))){
								echo "WIP";
								return true;
							}else{
							  
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
						if(!(file_exists($this->getDataFolder()."Islands/".$sender->getName().".txt"))){
							$sender->sendMessage($bn . $is_noisland);
							return true;
						}else{
						  
							$level = $this->getServer()->getLevelByName(yaml_parse_file($this->getDataFolder()."Players/".$sender->getName().".txt"));
							if($level !== null){
								$sender->sendMessage(TextFormat::GREEN . $bn . $is_teleporting);
								if($sender->getLevel()->getName() !== $level->getName()){
									$sender->sendMessage($bn . $is_home_error);
									return true;
								}else{
									$sender->teleport(new Vector3(yaml_parse_file($this->getDataFolder()."Islands/".$sender->getName().".txt")));
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
								if(file_exists($this->getDataFolder()."Islands/".$sender->getName().".txt")){
									unlink($this->getDataFolder()."Islands/".$sender->getName().".txt");
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
								if(file_exists($this->getDataFolder()."Islands/".$sender->getName().".txt")){
									$file = $this->getDataFolder()."Islands/".$sender->getName().".txt";
									unlink($file);
									$newFile = fopen($file, "w");
									fwrite($newFile, $sender->x.", ".$sender->y.", ".$sender->z);;
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
			}
		}

	
	// When a player joins
	public function onPlayerJoinEvent(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		if(file_exists($this->getDataFolder()."Players/".$player->getName().".txt")){
			$player->sendMessage($info_welcomeback. $player->getName());
		}else{
			$this->getLogger()->notice(TextFormat::GOLD . $info_newplayerjoin . $player->getName());
		}
	}
}
