<?php

namespace SkyBlockXT\Tools;

use pocketmine\plugin\PluginBase;
use pocketmine\level\generator\Generator;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\level\generator\biome\Biome;
use pocketmine\level\ChunkManager;
use pocketmine\utils\Random;

class SkyWorld extends Generator{
	
	private $options;
	private $block, $radius, $floorLevel,$biome,$baseFloor;
	/** @var ChunkManager */
	private $level;
	/** @var Random */
	private $random;
	/** @var FullChunk Chunk master */
	private $chunk;
	public function __construct(array $options = []) {
		$this->block = Block::STONE;
		$this->radius = 10;
		$this->floorLevel = 64;
		$this->biome = 1;
		$this->options = $options;
		$this->chunk  = null;
		$this->baseFloor = Block::AIR;
	}
	public function init(ChunkManager $level, Random $random) {
		$this->level = $level;
		$this->random = $random;
		// Parse options...
		if (isset($this->options["preset"])) {
			$preset = ",".strtolower($this->options["preset"]).",";
			if (preg_match('/,\s*block\s*=\s*(\d+)\s*,/',$preset,$mv)) {
				$this->block = intval($mv[1]);
			}
			if (preg_match('/,\s*radius\s*=\s*(\d+)\s*,/',$preset,$mv)) {
				$this->radius = intval($mv[1]);
			}
			if (preg_match('/,\s*floorlevel\s*=\s*(\d+)\s*,/',$preset,$mv)) {
				$this->floorLevel = intval($mv[1]);
			}
			if (preg_match('/,\s*biome\s*=\s*(\d+)\s*,/',$preset,$mv)) {
				$this->biome = intval($mv[1]);
			}
			if (preg_match('/,\s*basefloor\s*=\s*(\d+)\s*,/',$preset,$mv)) {
				$this->baseFloor = intval($mv[1]);
			}
		}
	}
	protected static function inSpawn($rad2,$spx,$spz,$x,$z){
		$xoff = $spx - $x;
		$zoff = $spz - $z;
		return $rad2 > ($xoff * $xoff + $zoff * $zoff);
	}
		public function generateChunk($chunkX, $chunkZ){
		$CX = ($chunkX % 5) < 0?(($chunkX % 5) + 5):($chunkX % 5);
		$CZ = ($chunkZ % 5) < 0?(($chunkZ % 5) + 5):($chunkZ % 5);
		switch($CX . ":" . $CZ){
			case '0:0':
				{
					if($this->chunk1 === null){
						$this->chunk1 = clone $this->level->getChunk($chunkX, $chunkZ);
						
						$c = Biome::getBiome(1)->getColor();
						$R = $c >> 16;
						$G = ($c >> 8) & 0xff;
						$B = $c & 0xff;
						for($x = 0; $x < 16; $x++){
							for($z = 0; $z < 16; $z++){
								$this->chunk1->setBiomeColor($x, $z, $R, $G, $B);
							}
						}
						for($x = 4; $x < 11; $x++){
							for($z = 4; $z < 11; $z++){
								$this->chunk1->setBlockId($x, self::bedrockheight + (68 - 64), $z, Block::GRASS);
							}
						}
						$this->chunk1->setBlockId(7, self::bedrockheight + (65 - 64), 7, Block::SAND); // 1
						$this->chunk1->setBlockId(7, self::bedrockheight + (66 - 64), 7, Block::SAND); // 2
						$this->chunk1->setBlockId(7, self::bedrockheight + (67 - 64), 7, Block::SAND); // 3
						$this->chunk1->setBlockId(7, self::bedrockheight + (69 - 64), 7, Block::LOG); // 5
						$this->chunk1->setBlockId(7, self::bedrockheight + (70 - 64), 7, Block::LOG); // 6
						$this->chunk1->setBlockId(7, self::bedrockheight + (71 - 64), 7, Block::LOG); // 7
						$this->chunk1->setBlockId(7, self::bedrockheight + (72 - 64), 7, Block::LOG); // 8
						$this->chunk1->setBlockId(7, self::bedrockheight + (73 - 64), 7, Block::LOG); // 9
						$this->chunk1->setBlockId(4, self::bedrockheight + (68 - 64), 4, Block::AIR); // 68
						$this->chunk1->setBlockId(4, self::bedrockheight + (68 - 64), 10, Block::AIR);
						$this->chunk1->setBlockId(10, self::bedrockheight + (68 - 64), 4, Block::AIR);
						$this->chunk1->setBlockId(10, self::bedrockheight + (68 - 64), 10, Block::AIR);
						$this->chunk1->setBlockId(5, self::bedrockheight + (72 - 64), 5, Block::AIR); // 72
						$this->chunk1->setBlockId(5, self::bedrockheight + (72 - 64), 9, Block::AIR);
						$this->chunk1->setBlockId(9, self::bedrockheight + (72 - 64), 5, Block::AIR);
						$this->chunk1->setBlockId(9, self::bedrockheight + (72 - 64), 9, Block::AIR);
						$this->chunk1->setBlockId(5, self::bedrockheight + (73 - 64), 7, Block::LEAVES); // 73
						$this->chunk1->setBlockId(7, self::bedrockheight + (73 - 64), 5, Block::LEAVES);
						$this->chunk1->setBlockId(9, self::bedrockheight + (73 - 64), 7, Block::LEAVES);
						$this->chunk1->setBlockId(7, self::bedrockheight + (73 - 64), 9, Block::LEAVES);
						$this->chunk1->setBlockId(7, self::bedrockheight + (74 - 64), 6, Block::LEAVES); // 74
						$this->chunk1->setBlockId(6, self::bedrockheight + (74 - 64), 7, Block::LEAVES);
						$this->chunk1->setBlockId(8, self::bedrockheight + (74 - 64), 7, Block::LEAVES);
						$this->chunk1->setBlockId(7, self::bedrockheight + (74 - 64), 8, Block::LEAVES);
						$this->chunk1->setBlockId(7, self::bedrockheight + (75 - 64), 7, Block::LEAVES); // 75
						// $this->chunk1->setBlockId(7, self::bedrockheight + (69 - 64), 8, Block::CHEST);
						$this->chunk1->setBlockId(7, self::bedrockheight + (65 - 64), 8, Block::DIRT); // 65
						$this->chunk1->setBlockId(8, self::bedrockheight + (65 - 64), 7, Block::DIRT);
						$this->chunk1->setBlockId(7, self::bedrockheight + (65 - 64), 6, Block::DIRT);
						$this->chunk1->setBlockId(6, self::bedrockheight + (65 - 64), 7, Block::DIRT);
						$this->chunk1->setBlockId(5, self::bedrockheight + (66 - 64), 7, Block::DIRT); // 66
						$this->chunk1->setBlockId(7, self::bedrockheight + (66 - 64), 5, Block::DIRT);
						$this->chunk1->setBlockId(9, self::bedrockheight + (66 - 64), 7, Block::DIRT);
						$this->chunk1->setBlockId(7, self::bedrockheight + (66 - 64), 9, Block::DIRT);
						$this->chunk1->setBlockId(4, self::bedrockheight + (67 - 64), 7, Block::DIRT); // 67
						$this->chunk1->setBlockId(7, self::bedrockheight + (67 - 64), 4, Block::DIRT);
						$this->chunk1->setBlockId(7, self::bedrockheight + (67 - 64), 10, Block::DIRT);
						$this->chunk1->setBlockId(10, self::bedrockheight + (67 - 64), 7, Block::DIRT);
					}
					$chunk = clone $this->chunk1;
					$chunk->setX($chunkX);
					$chunk->setZ($chunkZ);
					$this->level->setChunk($chunkX, $chunkZ, $chunk);
					break;
				}
			
			default:
				{
					if($this->chunk2 === null){
						$this->chunk2 = clone $this->level->getChunk($chunkX, $chunkZ);
						
						$c = Biome::getBiome(1)->getColor();
						$R = $c >> 16;
						$G = ($c >> 8) & 0xff;
						$B = $c & 0xff;
						for($x = 0; $x < 16; $x++){
							for($z = 0; $z < 16; $z++){
								$this->chunk2->setBiomeColor($x, $z, $R, $G, $B);
							}
						}
						$chunk = clone $this->chunk2;
						$chunk->setX($chunkX);
						$chunk->setZ($chunkZ);
						$this->level->setChunk($chunkX, $chunkZ, $chunk);
						break;
					}
				}
		}
	}
	public function populateChunk($chunkX, $chunkZ) {
		// Don't do nothing here...
	}
	public function getSettings() {
		return $this->options;
	}
	public function getName() {
		return self::NAME;
	}
	public function getSpawn() {
		return new Vector3(128,$this->floorLevel+1,128);
	}
}
