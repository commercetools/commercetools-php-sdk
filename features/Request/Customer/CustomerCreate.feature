Feature: I want to create a new customer
  Scenario: create a customer
    Given i have a "customer" "email" with value "john.doe@company.com"
    And i have a "customer" "firstName" with value "John"
    And i have a "customer" "lastName" with value "Doe"
    And i have a "customer" "password" with value "password"
    Given i have a "customer" draft
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
