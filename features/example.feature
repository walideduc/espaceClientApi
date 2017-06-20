Feature: Testing
  In order to learn behat
  I do some tests

  Scenario: Home page
    Given I am on the homepage
    Then I should see "Laravel"

  Scenario: Dashboard is locked to guest
    Given I am on the homepage
    And I can do some thing with Laravel

  Scenario: User is persited in test database
    Given a user with id "1" and email "walideduc@gmail.com" in the data base
    Then I should see user with id "1" and email "walideduc@gmail.com"