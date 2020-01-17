<?php


namespace App;
use App\Server;
use App\Vm;
use Exception;

class Vmcheck
{
    private $vmMachin=array();
    private $server;

    public function __construct(Server $server)
    {
        $this->server=$server;
    }
    public function addVm(Vm $vm)
    {
    array_push ( $this->vmMachin,$vm); return $this->vmMachin;
    }


    public function arrayVm(){
        return $this->vmMachin;
    }

    private function allResource($arrayVm){
        $resource=["cpu"=>0,"ram"=>0,"hdd"=>0];
        foreach ($arrayVm as $value){
            if( !$this->server->isValidVm($value) ) continue;
            $resource['cpu']+=$value->cpu;
            $resource['ram']+=$value->ram;
            $resource['hdd']+=$value->hdd;
        }
        if ($resource['cpu'] === 0 ) {
            throw new Exception("Error resource assign");
            return $resource;
        }
        return $resource;
    }

    public function result($server,$arrayVm){
        try {
            $resourceNeed = $this->allResource($arrayVm);
            $serverdivition = array();
            $cpuServer = $server->cpu;
            $ramServer = $server->ram;
            $hddServer = $server->hdd;

            $serverdivition = [
                ceil($resourceNeed['cpu'] / $cpuServer),
                ceil($resourceNeed['ram'] / $ramServer),
                ceil($resourceNeed['hdd'] / $hddServer)];
            // var_dump($serverdivition);

            return max($serverdivition);
        }catch (Exception $exception) {
            return $exception->getMessage();
        }

    }
}
