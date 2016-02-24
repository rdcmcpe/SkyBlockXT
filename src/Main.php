<?php
#TTTTTTTTTTTTTTTTTTTTTTTKKKKKKKKK    KKKKKKKRRRRRRRRRRRRRRRRR   TTTTTTTTTTTTTTTTTTTTTTT
#T:::::::::::::::::::::TK:::::::K    K:::::KR::::::::::::::::R  T:::::::::::::::::::::T
#T:::::::::::::::::::::TK:::::::K    K:::::KR::::::RRRRRR:::::R T:::::::::::::::::::::T
#T:::::TT:::::::TT:::::TK:::::::K   K::::::KRR:::::R     R:::::RT:::::TT:::::::TT:::::T
#TTTTTT  T:::::T  TTTTTTKK::::::K  K:::::KKK  R::::R     R:::::RTTTTTT  T:::::T  TTTTTT
#        T:::::T          K:::::K K:::::K     R::::R     R:::::R        T:::::T        
#        T:::::T          K::::::K:::::K      R::::RRRRRR:::::R         T:::::T        
#        T:::::T          K:::::::::::K       R:::::::::::::RR          T:::::T        
#        T:::::T          K:::::::::::K       R::::RRRRRR:::::R         T:::::T        
#        T:::::T          K::::::K:::::K      R::::R     R:::::R        T:::::T        
#        T:::::T          K:::::K K:::::K     R::::R     R:::::R        T:::::T        
#        T:::::T        KK::::::K  K:::::KKK  R::::R     R:::::R        T:::::T        
#      TT:::::::TT      K:::::::K   K::::::KRR:::::R     R:::::R      TT:::::::TT      
#      T:::::::::T      K:::::::K    K:::::KR::::::R     R:::::R      T:::::::::T      
#      T:::::::::T      K:::::::K    K:::::KR::::::R     R:::::R      T:::::::::T      
#      TTTTTTTTTTT      KKKKKKKKK    KKKKKKKRRRRRRRR     RRRRRRR      TTTTTTTTTTT		Creations

namespace SkyblockPVP;

use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\level\Location;
use pocketmine\plugin\PluginBase as Base;

use SkyBlockPVP\SkyLand\IsleGen as makeIsland; //Will now use.

class Main extends Base implements Listener{

	public function onEnable(){
        $this->loadLanguage();
		$this->saveDefaultConfig();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if(!(is_dir($this->getDataFolder()."Players/"))){
			$this->getLogger()->notice(TextFormat::YELLOW ."Players Path created!");
			@mkdir($this->getDataFolder()."Players/");
		}
		if(!(is_dir($this->getDataFolder()."Islands/"))){
			$this->getLogger()->notice(TextFormat::YELLOW ."Islands Path created!");
			@mkdir($this->getDataFolder()."Islands/");
		}
		$this->getLogger()->notice(TextFormat::AQUA . $msgload."Plugin Created by: TKRT");
	}
	public function onDisable(){
		$this->getLogger()->error(TextFormat::RED . $msgunload);
	}
	
	public function onCommand(CommandSender $sender, Command $command, $label, array $args){
		if(strtolower($command->getName()) == "is"){
			
		if(!(isset($args[0]))){
				$sender->sendMessage(TextFormat::AQUA . "---SkyBlock---");
				$sender->sendMessage(TextFormat::YELLOW . $msgerrornosbcmd );
				$sender->sendMessage(TextFormat::GREEN . $msgerrornosbcmduse. TextFormat::RESET . "/is help");
				return true;
			}elseif(isset($args[0])){
			if($args[0] == "help"){
					if($sender->hasPermission("is") || $sender->hasPermission("sbpvp.is.help")){
						if(!(isset($args[1])) or $args[1] == "1"){
							$sender->sendMessage(TextFormat::AQUA . "[Skyblock] ".$msgist);
							$sender->sendMessage(TextFormat::GREEN . "/is help ");
							$sender->sendMessage(TextFormat::GREEN . "/is create");
							$sender->sendMessage(TextFormat::GREEN . "/is delete");
							$sender->sendMessage(TextFormat::GREEN . "/is get <player> (OP)");
							$sender->sendMessage(TextFormat::GREEN . "/is warp <player> (OP)");
							return true;
						}elseif($args[1] == "2"){
							$sender->sendMessage($msghmcmds);
							return true;
						}
					}else{
						$sender->sendMessage(TextFormat::RED . "[SkyBlock] ".$msgerrorpermhl);
						return true;
					}
					}elseif($args[0] == "create"){
					if($sender->hasPermission("is") || $sender->hasPermission("sbpvp.is.create") || $sender->hasPermission("is.command.create")){
						$playerconform = $this->getConfig()->get('PlayerFileFormat');
						$playerIs = $this->getDataFolder()."Islands/".$sender->getName()."."$playerconform.;
						if($sender->getLevel()->getName() == $this->getConfig()->get("Lobby")){
							$sender->sendMessage(TextFormat::YELLOW."[Skyblock] ".$msgerrorycminlobby);
							return true;
						}else{
							if(!(file_exists($playerIs))){
								$this->makeIsland($sender->getName());
								return true;
							}else{
								$sender->sendMessage(TextFormat::YELLOW . "[Skyblock] ".$msgerrorycminlobby);
								return true;
							}
						}
					}else{
		
		}

	
	
	
	public function loadLanguage(){
        $lang = $this->getConfig()->get('Lang');
        if(!(is_dir($this->getDataFolder()."messages_".$lang.".yml")))
        {

        $this->plugin->saveResource("messages_".$lang.".yml", true);
        $msgload = $this->getResource("messges_".$lang.".yml")->get('msg_loadplugin');
        $msgunload = $this->getResource("messges_".$lang.".yml")->get('msg_unloadplugin');
		$msgcishelp = $this->getResource("messages_".$lang.".yml")->get('msg_showhelplist');
		$msghmcmds = $this->getResource("messages_".$lang.".yml")->get('msg_helpmorecommandssoon');
		$msgerrorpermhl = $this->getResource("messages_".$lang.".yml")->get('msg_errorcantseehelpmenu');
		$msgerrornosbcmd = $this->getResource("messages_".$lang.".yml")->get('msg_errornosubcommand');
		$msgerrornosbcmd = $this->getResource("messages_".$lang.".yml")->get('msg_errornosubcommanduse');
		$msgerrorycminlobby = $this->getResource("messages_".$lang.".yml")->get('msg_erroryoucantmakeislandinlobby');
		$msg = $this->getResource("messages_".$lang.".yml")->get('msg_');
		//$msg = $this->getResource("messages_".$lang.".yml")->get('msg_');
		//$msg = $this->getResource("messages_".$lang.".yml")->get('msg_');
		//$msg = $this->getResource("messages_".$lang.".yml")->get('msg_');
		//$msg = $this->getResource("messages_".$lang.".yml")->get('msg_');
		//$msg = $this->getResource("messages_".$lang.".yml")->get('msg_');

		
        }else{
        $this->getLogger()->notice(TextFormat::RED. "Language ".$lang." has not been found, please read the");
        $this->getLogger()->notice(TextFormat::RED. "Whole language list and any spelling error!");
        }
       
    }
	
