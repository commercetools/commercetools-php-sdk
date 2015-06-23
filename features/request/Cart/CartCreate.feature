Feature: I want to create a new cart
  Background:
    Given i have a "cart" draft with values
    """
    {
      "currency": "EUR",
      "customerId": "customer-1"
    }
    """

  Scenario: create a anonymous cart
    When i want to create a "cart"
    Then the path should be "/carts"
    And the method should be "POST"
    And the request should be
    """
    {
      "currency": "EUR",
      "customerId": "customer-1"
    }
    """
