<?php
namespace SkyXT\SkyBlock\subcommand;

use pocketmine\command\CommandSender;
use SkyXT\SkyBlock\SkyBlock;

abstract class SubCommand
{
    /** @var SkyXT\SkyBlock */
    private $plugin;

    /**
     * @param SkyXT\SkyBlock $plugin
     */
    public function __construct(SkyBlock $plugin){
        $this->plugin = $plugin;
    }

    /**
     * @return SkyXT\SkyBlock
     */
    public final function getPlugin(){
        return $this->plugin;
    }

    /**
     * @param CommandSender $sender
     * @return bool
     */
    public abstract function canUse(CommandSender $sender);

    /**
     * @return string
     */
    public abstract function getUsage();

    /**
     * @return string
     */
    public abstract function getName();

    /**
     * @return string
     */
    public abstract function getDescription();

    /**
     * @return string[]
     */
    public abstract function getAliases();

    /**
     * @param CommandSender $sender
     * @param string[] $args
     * @return bool
     */
    public abstract function execute(CommandSender $sender, array $args);
}
