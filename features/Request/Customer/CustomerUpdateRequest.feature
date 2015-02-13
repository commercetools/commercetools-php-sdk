Feature: I want to send a Customer Update Request
  Scenario: Change user name
    Given i want to update a "Customer"
    When i "change" the "name" to "John Doe"
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeName",
          "firstName": "John",
          "lastName": "Doe"
        }
      ]
    }
    """
  Scenario: Change email address
    Given i want to update a "Customer"
    When i "change" the "email" to "john.doe@company.com"
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeEmail",
          "email": "john.doe@company.com"
        }
      ]
    }
    """
  Scenario: Add an address to customer
    Given i want to update a "Customer"
    And i have the "common" object "address"
    And set the objects "firstName" to "John"
    And set the objects "lastName" to "Doe"
    And i "add" the "address" object to "Customer"
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addAddress",
          "address": {
            "firstName": "John",
            "lastName": "Doe"
          }
        }
      ]
    }
    """
