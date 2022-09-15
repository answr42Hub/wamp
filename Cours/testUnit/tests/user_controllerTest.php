<?php


use PHPUnit\Framework\TestCase;

class user_controllerTest extends TestCase {
    public function testList() {

        $repo = $this->getMockBuilder(userrepository::class)
            ->getMock();
        $repo->method('count')->willReturn(42);

        $controller = new usercontroller($repo);
        $awaited = 'ok';

        $result = $controller->list();

        $this->assertEquals($awaited, $result);
    }
    public function testListMock() {
        $mock = $this->getMockBuilder(usercontroller::class)
            ->onlyMethods(['afficher_erreur'])
            ->getMock();
        $mock->expects($this->once())->method('afficher_erreur');

        $mock->toto(0);
    }
}
