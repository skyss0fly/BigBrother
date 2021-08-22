<?php

namespace shoghicp\BigBrother\events;

use pocketmine\event\Event;
use shoghicp\BigBrother\DesktopPlayer;
use shoghicp\BigBrother\network\ProtocolInterface;

class DesktopPlayerCreationEvent extends Event{
	/** @var ProtocolInterface */
	private $interface;
	/** @var string */
	private $baseClass;
	/** @var string */
	private $playerClass;
	/** @var string */
	private $clientID;
	/** @var string */
	private $address;
	/** @var int */
	private $port;

	public function __construct(ProtocolInterface $interface, string $playerClass, string $baseClass, string $address, int $port, string $clientID)
	{
		$this->interface = $interface;
		$this->address = $address;
		$this->port = $port;
		$this->clientID = $clientID;

		if(!is_a($baseClass, DesktopPlayer::class, true)) {
			throw new \RuntimeException("Base class $baseClass must extend " . DesktopPlayer::class);
		}

		$this->baseClass = $baseClass;

		if(!is_a($playerClass, DesktopPlayer::class, true)) {
			throw new \RuntimeException("Player class $playerClass must extend " . DesktopPlayer::class);
		}

		$this->playerClass = $playerClass;
	}

	/**
	 * @return ProtocolInterface
	 */
	public function getInterface() : ProtocolInterface{
		return $this->interface;
	}

	/**
	 * @return string
	 */
	public function getAddress() : string{
		return $this->address;
	}

	/**
	 * @return int
	 */
	public function getPort() : int{
		return $this->port;
	}

	/**
	 * @return string
	 */
	public function getBaseClass(){
		return $this->baseClass;
	}

	/**
	 * @param string $class
	 */
	public function setBaseClass($class){
		if(!is_a($class, $this->baseClass, true)){
			throw new \RuntimeException("Base class $class must extend " . $this->baseClass);
		}

		$this->baseClass = $class;
	}

	/**
	 * @return string
	 */
	public function getPlayerClass(){
		return $this->playerClass;
	}

	/**
	 * @param string $class
	 */
	public function setPlayerClass($class){
		if(!is_a($class, $this->baseClass, true)){
			throw new \RuntimeException("Class $class must extend " . $this->baseClass);
		}

		$this->playerClass = $class;
	}

	/**
	 * @return string
	 */
	public function getClientID() : string {
		return $this->clientID;
	}
}