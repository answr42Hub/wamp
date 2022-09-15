<?php


use PHPUnit\Framework\TestCase;

class mathematicTest extends TestCase {
    private mathematic $math;
    protected function setUp(): void {
        parent::setUp();
        $this->math = new mathematic();
    }

    /**
     * @dataProvider additionProvider
     */

    public function testAdd(int $nb1, int $nb2, int $resultatAttendu) {
        // Arange
        // Act Act
        $resultat = $this->math->add($nb1, $nb2);

        // Assert
        $this->assertEquals($resultatAttendu, $resultat);
    }

    private function additionProvider() {
        return [
            [18, 24, 42],
            [0, 0, 0],
            [-1, 1, 0],
            [9, 9, 18]
        ];
    }

    public function testDivInt() {
        // Arange
        $nb1 = 8;
        $nb2 = 2;
        $resultatAttendu = 4;
        // Act Act
        $resultat = $this->math->divide($nb1, $nb2);

        // Assert
        $this->assertEquals($resultatAttendu, $resultat);
    }

    public function testDivZero() {
        // Arange
        $nb1 = 8;
        $nb2 = 0;

        // Assert
        $this->expectException(Exception::class);

        //Act
        $resultat = $this->math->divide($nb1, $nb2);
    }
}
