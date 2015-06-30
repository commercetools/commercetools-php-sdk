Feature: I want to update a discount code
  Background:
    Given a "discountCode" is identified by "id" and "version"
  Scenario: Empty update
    Given i want to update a "discountCode"
    Then the path should be "discount-codes/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
      ]
    }
    """
