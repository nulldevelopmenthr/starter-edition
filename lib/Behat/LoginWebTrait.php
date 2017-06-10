<?php

declare(strict_types=1);

namespace Resources\Behat;

/**
 * Behat trait.
 */
trait LoginWebTrait
{
    /**
     * Opens login.
     *
     * @Given /^(?:|I )am on (?:|the )login page$/
     * @When /^(?:|I )go to (?:|the )login page$/
     */
    public function iAmOnLoginPage()
    {
        $this->visitPath('/login');
    }

    /**
     * Checks, that current page is login page.
     *
     * @Then /^(?:|I )should be on (?:|the )login page$/
     */
    public function assertLoginPage()
    {
        $this->assertSession()->addressEquals($this->locatePath('/login'));
    }

    /**
     * @Given I am logged in as :username
     *
     * @param $username
     */
    public function iAmLoggedInAs($username)
    {
        $this->logUserIn($username);
    }

    /**
     * @param $username
     */
    private function logUserIn($username)
    {
        $this->iAmOnLoginPage();
        $this->fillField('username', $username);
        $this->fillField('password', 'pass123');
        $this->pressButton('Log in');
    }
}
