<?php


use PHPUnit\Framework\TestCase;

class NumberDetectorTest extends TestCase {

    private NumberDetector $numdetector;
    protected function setUp(): void {
        parent::setUp();
        $this->numdetector = new NumberDetector();
    }

    public function addIfNotExist() {

        $repo = $this->getMockBuilder(NumberRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $repo->method('addIfNotExist')->willReturn(true);


        $awaited = false;

        $result = $this->numdetector->addIfNotExist(42);

        $this->assertEquals($awaited, $result);
    }

    public function testaddIfNotExistMock() {
        $mock = $this->getMockBuilder(NumberDetector::class)
            ->onlyMethods(['afficher_erreur'])
            ->getMock();
        $mock->expects($this->once())->method('afficher_erreur');

        $mock->tata(13);
    }
}
