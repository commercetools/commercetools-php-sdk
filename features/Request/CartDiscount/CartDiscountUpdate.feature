Feature: I want to update a cart discount
  Background:
    Given a "cartDiscount" is identified by "id" and "version"
  Scenario: Empty update
    Given i want to update a "CartDiscount"
    Then the path should be "cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
      ]
    }
    """
