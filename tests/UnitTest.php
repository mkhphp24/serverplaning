<?php

use PHPUnit\Framework\TestCase;
use App\Vm;
use App\Server;
use App\Vmcheck;

class UnitTest extends  TestCase
{
    private $server;
    private $Vmcheck;


    protected   function   setUp ( ) :   void
    {

        $this->server = Server::getInstacne(2, 32, 100);

        $this->vmcheck=new Vmcheck( $this->server);

    }


    public function testServerIsValidVm(){

        $this->assertEquals( $this->server->isValidVm( Vm::createVm(2,32,100)),true);
        $this->assertEquals( $this->server->isValidVm( Vm::createVm(2,32,150)),false);
    }

    public function testVmcheckAddVm(){
        $Vmarray=$this->vmcheck->addVm(Vm::createVm(1,32,50));
        $this->assertEquals($Vmarray, [Vm::createVm(1,32,50)]);
    }


    public function testVmcheckResult(){
        $this->assertEquals(1,1);
        $this->assertEquals( $this->vmcheck->result($this->server, [Vm::createVm(2,32,100)]),1);
        $this->assertEquals( $this->vmcheck->result($this->server, [Vm::createVm(1,16,50),Vm::createVm(1,16,50)]),1);
        $this->assertEquals( $this->vmcheck->result($this->server, [Vm::createVm(1,16,50),Vm::createVm(1,16,50),Vm::createVm(1,16,50)]),2);
        $this->assertEquals( $this->vmcheck->result($this->server, [Vm::createVm(1,16,150),Vm::createVm(1,16,100)]),1);
        $this->assertEquals( $this->vmcheck->result($this->server, [Vm::createVm(1,16,150)]),"Error resource assign");
    }

}
