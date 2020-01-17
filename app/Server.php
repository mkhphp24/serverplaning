<?php

namespace App;
use App\Vm;
use Exception;

class Server
{
    private static $instance = null;
    public $cpu;
    public $ram;
    public $hdd;

    private function __construct($cpu,$ram,$hdd)
    {
        $this->cpu=$cpu;
        $this->ram=$ram;
        $this->hdd=$hdd;

        if ( $this->cpu === 0 ||  $this->ram === 0  || $this->hdd === 0  )
            throw new Exception("Error resource Server");

    }




     static function getInstacne($cpu,$ram,$hdd) {
        if(self::$instance == null) {
            self::$instance = new Server($cpu,$ram,$hdd);
        }

        return self::$instance;
    }
/*
 *
 */
    public  function isValidVm(Vm $vm){
       if (
        ( $this->cpu >= $vm->cpu ?  true :  false ) &&
        ( $this->ram >= $vm->ram ?  true :  false ) &&
        ( $this->hdd >= $vm->hdd ?  true :  false ) ) return true; else false;
    }





}
