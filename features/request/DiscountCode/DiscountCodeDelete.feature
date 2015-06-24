Feature: I want to delete a discount code
  Scenario: Delete discount code
    Given a "discountCode" is identified by "id" and version 1
    And i want to delete a "discountCode"
    Then the path should be "/discount-codes/id?version=1"
    And the method should be "DELETE"
