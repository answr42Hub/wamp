<?php

class loginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('src/index.php');
    }

    // tests
    /*
     * Number is positive, multi5, and bof
     */
    public function addSuccess(AcceptanceTester $I)
    {
        $I->fillField("Nombre", 45);
        $I->click("Faire les tests");
        $I->see("Le nombre 45:");
        $I->see("Est positif");
        $I->see("Est un multiple de 5");
        $I->see("Bof");
    }

    /*
     * Number is negative, not multi5 and bof
     */
    public function numAlreadyThere(AcceptanceTester $I)
    {
        $I->fillField("Nombre", -46);
        $I->click("Faire les tests");
        $I->see("Le nombre -46:");
        $I->see("Est négatif ou null");
        $I->see("N'est pas un multiple de 5");
        $I->see("Bof");
    }
    /*
     * Number is positive, multi5 and awsome
     */
    public function numIsNotValid(AcceptanceTester $I)
    {
        $I->fillField("Nombre", -46);
        $I->click("Faire les tests");
        $I->see("Le nombre 42:");
        $I->see("Est Positif");
        $I->see("N'est pas un multiple de 5");
        $I->see("La réponse à la grande question sur la vie, l'univers et le reste");
    }
}
