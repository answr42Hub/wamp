<?php

use PHPUnit\Framework\TestCase;

class UnitaireTest extends TestCase {
    private Unitaire $unit;
    protected function setUp(): void {
        parent::setUp();
        $this->unit = new Unitaire();
    }

    /**
     * @dataProvider unitProvider
     */

    public function testFonctionATester(int $nb1, int $nb2, int $resultatAttendu) {
        // Arange
        $resultat = $this->unit->fonctionATester($nb1, $nb2);

        // Assert
        $this->assertEquals($resultatAttendu, $resultat);
    }

    private function unitProvider() {
        return [
            [18, 2, 9],
            [0, 5, 0],
            [666, 3, 111]
        ];
    }

    public function testIsInt() {
        // Arange
        $nb = "neuf";
        $resultatattendu = true;

        //Act
        $resultat = $this->unit->IsInt($nb);

        // assert
        $this->assertEquals($resultatattendu, $resultat);
    }

    public function testIsNotInt() {

        $unit = $this->getMockBuilder(Unitaire::class)
            ->getMock();
        $unit->method('IsInt')->willReturn(false);

        // Arange
        $nb = "cing";
        $resultatattendu = false;

        //Act
        $resultat = $this->unit->IsInt($nb);

        // assert
        $this->assertEquals($resultatattendu, $resultat);
    }
}
