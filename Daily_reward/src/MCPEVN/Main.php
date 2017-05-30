<?php
namespace MCPEVN;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\item\Item;

class Main extends PluginBase implements Listener{


   public function onEnable(){
        if(!is_dir($this->getDataFolder()))	{
        mkdir($this->getDataFolder());
        }
        $this->user = new Config($this->getDataFolder() ."user.yml", Config::YAML, []);//tạo config.yml
    }


    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
        if($cmd->getName()=="reward" or "rw"){
       	 $ten = $sender->getName();
       	 var_dump($ten);
        	$player = $sender->getServer()->getPlayer($ten);
			var_dump($player);
        	$date = date('Y-m-d');
        	
        	if($this->user->exists($ten)){
        		if(!$this->user->get($ten) == $date){
        			$sender->getInventory()->addItem(Item::get(378, 0, 3));
        			$sender->sendMessage('§b§o Chúc mừng bạn đã nhận quà hôm nay');
        			$this->user->set($ten,$date);
        			$this->user->save();
        		}
        		else{
        			$sender->sendMessage('§c§oHôm nay bạn đã nhận quà rồi');
        	   }
        	}else{
       	 	$sender->getInventory()->addItem(Item::get(378, 0, 3));
       	 	$sender->sendMessage('§b§o Chúc mừng bạn đã nhận quà hôm nay');
       	 	$this->user->set($ten,$date);
       	 	$this->user->save();
     		}
		}
		return 'true';
    }
}
