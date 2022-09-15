<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;
    /**
     * @Given i am on page :url
     */

    public function iAmOnPage($url)
    {
        $this->amOnPage($url);
    }
    /**
     * @When i have the number :num1 as :field
     */

    public function iFillFieldWith($num1, $field)
    {
        $this->fillField($field, $num1);
    }
    /**
     * @When i click on :label
     */
    public function iClickOn($label)
    {
        $this->click($label);
    }

    /**
     * @Then i should see :str
     */
    public function iShouldSee($str)
    {
        $this->see($str);
    }
}
