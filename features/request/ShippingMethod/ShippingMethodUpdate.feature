Feature: I want to update a shippingMethod
  Background:
    Given a "shippingMethod" is identified by "id" and "version"
  Scenario: Empty update
    Given i want to update a "shippingMethod"
    Then the path should be "/shipping-methods/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
      ]
    }
    """
