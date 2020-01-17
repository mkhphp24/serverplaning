<?php

namespace App\Controller;

use Exception;
use FirePHP;
use App\Vmcheck;
use App\Server;
use App\Vm;
class HomeController {
private $firephp;
    public function __construct()
    {
        $this->firephp = FirePHP::getInstance(true);
    	//Do your magic here
    }
    public function index()
    {
        $arrayVm=array();

        try {
        $server= Server::getInstacne(2,32,100);
        }catch (Exception $exception) {
            return $exception->getMessage();
        }

        $vmcheck=new Vmcheck($server);

        try {
             $arrayVm = $vmcheck->addVm(Vm::createVm(1, 16, 50));
             $arrayVm=$vmcheck->addVm(Vm::createVm(1,16,50));
             $arrayVm=$vmcheck->addVm(Vm::createVm(1,16,150));
             $arrayVm=$vmcheck->addVm(Vm::createVm(1,16,50));
            //  $arrayVm=$vmcheck->addVm(Vm::createVm(1,16,150));
        }
        catch (Exception $exception) {
            return $exception->getMessage();
        }

        var_dump($server);
        var_dump($vmcheck->arrayVm());

        return "<h1>Number of server : ".$vmcheck->result($server,$arrayVm)."</h1>";
    }


}
