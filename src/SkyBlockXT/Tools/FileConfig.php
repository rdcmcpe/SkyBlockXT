<?php

namespace SkyBlockXT\Tools;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;


class FileConfig {
	
public function onLoad() {
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
	if($this->getConfig()->get('EnableDebug') == true){
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] Saved Configuration Files: " .$tkrt);
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] config.yml at SkyBlockXT Folder" .$tkrt);
		$this->getLogger()->notice(TextFormat::GREEN . "[DEBUG] Loading Language Files..... " .$tkrt);
	}  	
	if(is_dir($this->getFile()."config.yml") == false){
	$this->saveDefaultConfig();
	}	
	if(is_dir($this->getFile()."config.yml") == true){
	$dla = $this->getConfig()->get("dla");
	$langg = $this->getConfig()->get("Language"); 
		if($dla = $langg){
			$this->saveResource("Lang-".$langg.".yml");
			$langfile = $this->getResource("Lang-".$langg.".yml");
			$CLobby = $this->getConfig()->("Lobby");
			$CMiny = $this->getConfig()->("MinY");
			$CDisx = $this->getConfig()->("DisX");
			$CDisz = $this->getConfig()->("DisZ");
			$CSKW = $this->getConfig()->("SkyWorldName");
			$CDebug = $this->getConfig()->("EnableDebug");
			$Cewg = $this->getConfig()->("EnableWorldGenerators");
			$Cuuid = $this->getConfig()->("EnableUUID");
			$Cipw = $this->getConfig()->("IslandPerWorld");
			$Cest = $this->getConfig()->("EnableSkyTools");
			$Cpvpe = $this->getConfig()->("PVPEnableOnIslands");
			$Cauos = $this->getConfig()->("AutoUpdateOnStart");
			$langfile()->set("MinY", $CMiny);
			$langfile()->set("DisX", $CDisx);
			$langfile()->set("DisZ", $CDisz );
			$langfile()->set("SkyWorldName", $CSKW);
			$langfile()->set("EnableDebug", $CDebug);
			$langfile()->set("EnableWorldGenerators", $Cewg);
			$langfile()->set("EnableUUID", $Cuuid);
			$langfile()->set("IslandPerWorld", $Cipw);
			$langfile()->set("EnableSkyTools", $Cest);
			$langfile()->set("PVPEnableOnIslands", $Cpvpe);
			$langfile()->set("AutoUpdateOnStart", $Cauos);
			$langfile()->set("Lobby", $CLobby);
			$this->getConfig()->save(); // Saves the config
			unlink("config.yml");
			rename("Lang-".$langg.".yml", "config.yml");
		}
	}
	
		$langConfig = $this->getConfig();
		$info_pluginloaded = $langConfig->get("INFO.PluginLoaded");
		$this->getLogger()->info(TextFormat::BLUE ."".$info_pluginloaded."");

    }
}
