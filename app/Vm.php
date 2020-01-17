<?php


namespace App;


 use Exception;

 class Vm
{
     public $cpu;
     public $ram;
     public $hdd;

    public function __construct($cpu,$ram,$hdd)
    {
        $this->cpu=$cpu;
        $this->ram=$ram;
        $this->hdd=$hdd;
        if ( $this->cpu === 0 ||  $this->ram === 0  || $this->hdd === 0  )
            throw new Exception("Error resource VM");
    }

     static function createVm($cpu,$ram,$hdd)
    {
        return new Vm($cpu,$ram,$hdd);
    }

}
