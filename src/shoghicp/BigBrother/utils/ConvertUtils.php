<?php

/*
 * BigBrother plugin for PocketMine-MP
 * Copyright (C) 2014 shoghicp <https://github.com/shoghicp/BigBrother>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
*/

namespace shoghicp\BigBrother\utils;

use pocketmine\item\Item;
use pocketmine\entity\Human;

class ConvertUtils{

	/*
	* $iscomputer = true is PE => PC
	* $iscomputer = false is PC => PE
	*/
	public static function convertNBTData($iscomputer, &$nbt){

	}

	/*
	* $iscomputer = true is PE => PC
	* $iscomputer = false is PC => PE
	*/
	public static function convertItemData($iscomputer, &$item){
		$itemidlist = [//TODO: move to class public
			[
				[243, 0], [3, 2] //Podzol
			],
			[
				[198, -1], [208, -1] //Grass Path
			],
			[
				[247, -1], [19, 0] //Nether Reactor Core is Sponge
			],
			[
				[157, -1], [125, -1] //Double slab
			],
			[
				[158, -1], [126, -1] //Stairs
			],
			[
				[208, 0], [198, 0] //End Rod
			],
			[
				[241, -1], [95, -1] //Stained Glass
			],
			[
				[182, 1], [205, 0] //Purpur Slab
			],
			[
				[181, 1], [204, 0] //Double Purpur Slab
			],
			[
				[95, 0], [166, 0] //Double Purpur Slab
			],
			[
				[325, 8], [326, 0] //Water bucket
			],
			[
				[325, 10], [327, 0] //Lava bucket
			],
			[
				[325, 1], [335, 0] //Milk bucket
			],
			[
				[155, -1], [155, 0] //Block of Quartz TODO: check data
			],
			/*
			[
				[PE], [PC]
			],
			*/
		];

		if($iscomputer){
			$itemid = $item->getId();
			$itemdamage = $item->getDamage();
			$itemcount = $item->getCount();
			$itemnbt = $item->getCompoundTag();

			foreach($itemidlist as $convertitemdata){
				if($convertitemdata[0][0] === $item->getId()){
					if($convertitemdata[0][1] === -1){
						$itemid = $convertitemdata[1][0];
						if($convertitemdata[1][1] !== -1){
							$itemdamage = $convertitemdata[1][1];
						}else{
							$itemdamage = $item->getDamage();
						}
						break;
					}elseif($convertitemdata[0][1] === $item->getDamage()){
						$itemid = $convertitemdata[1][0];
						$itemdamage = $convertitemdata[1][1];
						break;
					}
				}
			}

			$item = new ComputerItem($itemid, $itemdamage, $itemcount, $itemnbt);
		}else{
			$itemid = $item->getId();
			$itemdamage = $item->getDamage();
			$itemcount = $item->getCount();
			$itemnbt = $item->getCompoundTag();

			foreach($itemidlist as $convertitemdata){
				if($convertitemdata[1][0] === $item->getId()){
					if($convertitemdata[1][1] === -1){
						$itemid = $convertitemdata[0][0];
						if($convertitemdata[0][1] !== -1){
							$itemdamage = $convertitemdata[0][1];
						}else{
							$itemdamage = $item->getDamage();
						}
						break;
					}elseif($convertitemdata[1][1] === $item->getDamage()){
						$itemid = $convertitemdata[0][0];
						$itemdamage = $convertitemdata[0][1];
						break;
					}
				}
			}

			$item = Item::get($itemid, $itemdamage, $itemcount, $itemnbt);
		}
	}

	/*
	* $iscomputer = true is PE => PC
	* $iscomputer = false is PC => PE
	*/
	public static function convertBlockData($iscomputer, &$blockid, &$blockdata){
		$blockidlist = [//TODO: move to class public
			[
				[243, 0], [3, 2] //Podzol
			],
			[
				[198, -1], [208, -1] //Grass Path
			],
			[
				[247, -1], [19, 0] //Nether Reactor Core is Sponge
			],
			[
				[157, -1], [125, -1] //Double slab
			],
			[
				[158, -1], [126, -1] //Stairs
			],
			[
				[208, 0], [198, 0] //End Rod
			],
			[
				[241, -1], [95, -1] //Stained Glass
			],
			[
				[182, 1], [205, 0] //Purpur Slab
			],
			[
				[181, 1], [204, 0] //Double Purpur Slab
			],
			[
				[95, 0], [166, 0] //Double Purpur Slab
			],
			[
				[155, -1], [155, 0] //Block of Quartz TODO: check data
			],
			/*
			[
				[PE], [PC]
			],
			*/
		];


		if($iscomputer){
			foreach($blockidlist as $convertblockdata){
				if($convertblockdata[0][0] === $blockid){
					if($convertblockdata[0][1] === -1){
						$blockid = $convertblockdata[1][0];
						if($convertblockdata[1][1] !== -1){
							$blockdata = $convertblockdata[1][1];
						}
						break;
					}elseif($convertblockdata[0][1] === $blockdata){
						$blockid = $convertblockdata[1][0];
						$blockdata = $convertblockdata[1][1];
						break;
					}
				}
			}
		}else{
			foreach($blockidlist as $convertblockdata){
				if($convertblockdata[1][0] === $blockid){
					if($convertblockdata[1][1] === -1){
						$blockid = $convertblockdata[0][0];
						if($convertblockdata[0][1] !== -1){
							$blockdata = $convertblockdata[0][1];
						}
						break;
					}elseif($convertblockdata[1][1] === $blockdata){
						$blockid = $convertblockdata[0][0];
						$blockdata = $convertblockdata[0][1];
						break;
					}
				}
			}
		}
	}

	public static function convertPEToPCMetadata(array $olddata){
		$newdata = [];

		foreach($olddata as $bottom => $d){
			switch($bottom){
				case Human::DATA_FLAGS://Flags
					$flags = 0;

					if(((int) $d[1] & (1 << Human::DATA_FLAG_ONFIRE)) > 0){
						$flags |= 0x01;
					}

					if(((int) $d[1] & (1 << Human::DATA_FLAG_SNEAKING)) > 0){
						$flags |= 0x02;
					}

					if(((int) $d[1] & (1 << Human::DATA_FLAG_SPRINTING)) > 0){
						$flags |= 0x08;
					}

					if(((int) $d[1] & (1 <<  Human::DATA_FLAG_INVISIBLE)) > 0){
						//$flags |= 0x20;
					}

					if(((int) $d[1] & (1 <<  Human::DATA_FLAG_SILENT)) > 0){
						$newdata[4] = [6, true];
					}

					if(((int) $d[1] & (1 <<  Human::DATA_FLAG_IMMOBILE)) > 0){
						//$newdata[11] = [0, true];
					}

					$newdata[0] = [0, $flags];
				break;
				case Human::DATA_AIR://Air
					$newdata[1] = [1, $d[1]];
				break;
				case Human::DATA_NAMETAG://Custom name
					//var_dump(bin2hex($d[1]));
					$newdata[2] = [3, str_replace("\n", "", $d[1])];//TODO
					$newdata[3] = [6, true];
				break;
				case Human::DATA_PLAYER_FLAGS:
				case Human::DATA_PLAYER_BED_POSITION:
				case Human::DATA_LEAD_HOLDER_EID:
				case Human::DATA_SCALE:
				case Human::DATA_MAX_AIR:
					//Unused
				break;
				default:
					echo "key: ".$bottom." Not implemented\n";
				break;
				//TODO: add data type
			}
		}

		$newdata["convert"] = true;

		return $newdata;
	}

}


class ComputerItem{
	public $id = 0, $damage = 0, $count = 0, $nbt = "";

	public function __construct($id = 0, $damage = 0, $count = 1, $nbt = ""){
		$this->id = $id;
		$this->damage = $damage;
		$this->count = $count;
		$this->nbt = $nbt;
	}

	public function getID(){
		return $this->id;
	}

	public function getDamage(){
		return $this->damage;
	}

	public function getCount(){
		return $this->count;
	}

	public function getCompoundTag(){
		return $this->nbt;
	}

}