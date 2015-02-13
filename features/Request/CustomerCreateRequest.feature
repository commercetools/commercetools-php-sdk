Feature: I want to create a new customer
  Scenario: create a customer
    Given i have a "customer" draft
    And the "email" is "john.doe@company.com"
    And the "firstName" is "John"
    And the "lastName" is "Doe"
    And the "password" is "password"
    And i want to create a "customer"
    Then the path should be "customers"
    And the method should be "POST"
    And the request should be
    """
    {
      "email": "john.doe@company.com",
      "firstName": "John",
      "lastName": "Doe",
      "password": "password"
    }
    """
