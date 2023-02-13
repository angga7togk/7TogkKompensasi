<?php

namespace Angga7Togk\Kompensasi;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use pocketmine\command\{Command, CommandSender};
use pocketmine\console\ConsoleCommandSender;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener {

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("config.yml");
        $this->saveResource("data.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
        $this->dt = new Config($this->getDataFolder() . "data.yml", Config::YAML, array());
        $this->getLogger()->info("\n---------------------------------------------------------------------------");
        $this->getLogger()->info("\n    ____   _____    ___     ___   _  __    ___   _____    ___    ___   ___ ");
        $this->getLogger()->info("\n   |__  | |_   _|  / _ \   / __| | |/ /   / __| |_   _|  / _ \  | _ \ | __|");
        $this->getLogger()->info("\n     / /    | |   | (_) | | (_ | | ' <    \__ \   | |   | (_) | |   / | _| ");
        $this->getLogger()->info("\n    /_/     |_|    \___/   \___| |_|\_\   |___/   |_|    \___/  |_|_\ |___|");
        $this->getLogger()->info("\n---------------------------------------------------------------------------");
        $this->getLogger()->info("\n          §lBeli Plugin Pocketmine-MP Premium Hanya Di Angga7Togk          ");
        $this->getLogger()->info("\n       §lJasa Remake Plugin Pocketmine-MP Premium Hanya Di Angga7Togk      ");
        $this->getLogger()->info("\n        §lJasa Buat Plugin Pocketmine-MP Premium Hanya Di Angga7Togk     ");
        $this->getLogger()->info("\n                          §lInstagram > @Angga7Togk                       ");
        $this->getLogger()->info("\n                          §lWhastApp  > 0882009557659                       ");
        $this->getLogger()->info("\n---------------------------------------------------------------------------");
        $this->cfg->setNested("Name", "7TogkKompensasi");
        $this->cfg->setNested("Type", "B AJA");
        $this->cfg->setNested("Author", "Angga7Togk");
        $this->cfg->setNested("Buy", "0882009557659");
        $this->cfg->setNested("Instagram", "Angga7Togk");
        $this->cfg->setNested("Warning", "Dilarang Di Jual Ulang! Jika Masih Ngeyel Menjual Ulang, Admin Bakal Melakukan Tindakan Tegas!");
        $this->cfg->save();
    }

    public function onDisable() : void {
        $this->getLogger()->info("\n---------------------------------------------------------------------------");
        $this->getLogger()->info("\n    ____   _____    ___     ___   _  __    ___   _____    ___    ___   ___ ");
        $this->getLogger()->info("\n   |__  | |_   _|  / _ \   / __| | |/ /   / __| |_   _|  / _ \  | _ \ | __|");
        $this->getLogger()->info("\n     / /    | |   | (_) | | (_ | | ' <    \__ \   | |   | (_) | |   / | _| ");
        $this->getLogger()->info("\n    /_/     |_|    \___/   \___| |_|\_\   |___/   |_|    \___/  |_|_\ |___|");
        $this->getLogger()->info("\n---------------------------------------------------------------------------");
        $this->getLogger()->info("\n          §lBeli Plugin Pocketmine-MP Premium Hanya Di Angga7Togk          ");
        $this->getLogger()->info("\n       §lJasa Remake Plugin Pocketmine-MP Premium Hanya Di Angga7Togk      ");
        $this->getLogger()->info("\n        §lJasa Buat Plugin Pocketmine-MP Premium Hanya Di Angga7Togk     ");
        $this->getLogger()->info("\n                          §lInstagram > @Angga7Togk                       ");
        $this->getLogger()->info("\n                          §lWhastApp  > 0882009557659                       ");
        $this->getLogger()->info("\n---------------------------------------------------------------------------");
        $this->cfg->setNested("Name", "7TogkKompensasi");
        $this->cfg->setNested("Type", "B AJA");
        $this->cfg->setNested("Author", "Angga7Togk");
        $this->cfg->setNested("Buy", "0882009557659");
        $this->cfg->setNested("Instagram", "Angga7Togk");
        $this->cfg->setNested("Warning", "Dilarang Di Jual Ulang! Jika Masih Ngeyel Menjual Ulang, Admin Bakal Melakukan Tindakan Tegas!");
        $this->cfg->save();
    }

    public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {
        if($cmd->getName() === "kompensasi"){
            $this->Kompensasi($sender);
            return true;
        }
    }

    public function Kompensasi(Player $player){

        $form = new SimpleForm(function(Player $player, $data = null){
            if($data === null) return true;
            
            $sender = $player;
            switch($data){
                case 0:
                    if($this->dt->exists('"'.$player->getName().'"')){
                        $player->sendMessage($this->cfg->get("msg-failed"));
                    }else{
                        foreach ($this->cfg->get("Reward") as $command) {
                            $this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), str_replace('{player}', '"' . $sender->getName() . '"', $command));
                        }
                        $player->sendMessage($this->cfg->get("msg-sukses"));
                        $this->dt->setNested('"'.$player->getName().'"', true);
                        $this->dt->save();
                    }
                    break;
                case 1:
                    break;
            }
            

        });
        $form->setTitle($this->cfg->get("Title"));
        $form->setContent($this->cfg->get("Content"));
        $form->addButton($this->cfg->get("Button-Name"));
        $form->addButton("§l§cExit\n§rTap To Enter!");
        $player->sendForm($form);
    }
}