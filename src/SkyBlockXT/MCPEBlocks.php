<?php

namespace SkyBlockXT\MCPEBlocks;

use pocketmine\block\Block;
use pocketmine\item\ItemBlock;
use pocketmine\item\Item;

class MCPEBlocks {
	
	public $list = [ ];
	public function __construct() {
		$this->init ();
	}
	public function init() {
		
		/*
		THIS MAY BE USELESS, BUT SOON ILL BE MAKING IT WORK
		WITH SKYLAND GENERATOR, OR EITHER MERGE THE CODE WITH IT
		*/
		
		$this->list ["AIR"] = 0;
		$this->list ["STONE"] = 1;
		$this->list ["GRASS"] = 2;
		$this->list ["DIRT"] = 3;
		$this->list ["COBBLESTONE"] = 4;
		$this->list ["SAPLING"] = 6;
		$this->list ["BEDROCK"] = 7;
		$this->list ["WATER"] = 8;
		$this->list ["LAVA"] = 10;
		$this->list ["SAND"] = 12;
		$this->list ["GRAVEL"] = 13;
		$this->list ["WOOD"] = 17;
		$this->list ["LEAVE"] = 18;
		$this->list ["LEAVES"] = 18;
		$this->list ["TORCH"] = 50;
		$this->list ["CHEST"] = 54;

	}
	
	public function getItemBlock($name) {

		 if (isset($this->list[strtoupper($name)])) {
		 	$bid = $this->list[strtoupper($name)];
		 	//return $block =  Block::get($bid, 0);
		 	return Item::get($bid);
		 }
		 return null;		 		
	}
	
}
