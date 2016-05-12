<?php

namespace SkyBlockXT;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;


class FileConfig {
	
public Function onLoad {
    $tkrt = TextFormat::AQUA . "[TKRT-SkyBlockXT]";
  // File/Folder Creation - Soon to Change the way it configures
	$this->getServer()->getPluginManager()->registerEvents($this, $this);
	if(!(is_dir($this->getDataFolder()."Players/"))){
		@mkdir($this->getDataFolder()."Players/");
	}
	if(!(is_dir($this->getDataFolder()."Islands/"))){
		@mkdir($this->getDataFolder()."Islands/");
	}
	if($this->getConfig()->get('EnableDebug') == true){
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] Islands and players Folder Created/Loaded.. Next Task" .$tkrt);
	}
	// End of File/Folder Creation
	$this->saveDefaultConfig();
	if($this->getConfig()->get('EnableDebug') == true){
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] Saved Configuration Files: " .$tkrt);
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] config.yml at SkyBlockXT Folder" .$tkrt);
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] Loading Language Files..... " .$tkrt);
	}  
    	
		// TEMPORAL MULTILANGUAGE SUPPORT ------------------------------------------------
		$defLang = $this->getConfig()->get('Language');
        if(!(is_dir($this->getDataFolder()."Lang-".$defLang.".yml"))){
			$this->saveResource("Lang-".$defLang.".yml");
		}	
		if($this->getConfig()->get('EnableDebug') == true){
			$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] Language file Saved. Language selected:". $deflang .$tkrt);
		}
		// TEMPORAL MULTILANGUAGE SUPPORT ------------------------------------------------
		

    }
}
