Feature: I want to create a new customer
  Scenario: create a customer
    Given i have a "customer" draft with values
    """
    {
      "email": "john.doe@example.org",
      "firstName": "John",
      "lastName": "Doe",
      "password": "password"
    }
    """
    When i want to create a "customer"
    Then the path should be "/customers"
    And the method should be "POST"
    And the request should be
    """
    {
      "email": "john.doe@example.org",
      "firstName": "John",
      "lastName": "Doe",
      "password": "password"
    }
    """
