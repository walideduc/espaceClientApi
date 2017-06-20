<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext ;
use PHPUnit_Framework_Assert as PHPUnit ;
use Laracasts\Behat\Context\DatabaseTransactions ;
use Laracasts\Behat\Context\Migrator;
/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext  implements Context
{
    Use Migrator;
    Use DatabaseTransactions ;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I can do some thing with Laravel
     */
    public function iCanDoSomeThingWithLaravel()
    {
        // You have access to Laravel because of laravel-behat-extension
        PHPUnit::assertEquals('.env.behat',app()->environmentFile());
        PHPUnit::assertEquals('testing',env('APP_ENV'));
        PHPUnit::assertTrue(config('app.debug'));

    }

    /**
     * @Given a user with id :arg1 and email :arg2 in the data base
     */
    public function aUserWithIdAndEmailInTheDataBase($user_id, $email)
    {
        $user = \App\User::create([
            'id' => $user_id,
            'first_name' => 'Walid',
            'last_name' => 'Salim',
            'email' => $email,
            'function' => 'user',
            'tel_fix' => '123546',
            'tel_portable' => '645896',
            'password' => bcrypt('secret')
        ]);
        $user->save();
    }

    /**
     * @Then I should see user with id :arg1 and email :arg2
     */
    public function iShouldSeeUserWithIdAndEmail($user_id, $email)
    {
        $user = \App\User::find($user_id);
        PHPUnit::assertTrue($user->email === $email);
    }
}
