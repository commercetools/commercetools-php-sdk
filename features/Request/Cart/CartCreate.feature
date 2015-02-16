Feature: I want to create a new cart
  Scenario: create a anonymous cart
    Given i have a "cart" "currency" with value "EUR"
    And i have a "cart" draft
    And set the objects "customerId" to "customer-1"
    And i want to create a "cart"
    Then the path should be "carts"
    And the method should be "POST"
    And the request should be
    """
    {
      "currency": "EUR",
      "customerId": "customer-1"
    }
    """
