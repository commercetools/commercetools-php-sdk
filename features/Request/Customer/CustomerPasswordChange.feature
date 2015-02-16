Feature: I want to change the customer's password
  Scenario: Create Token for password change
    Given i have the "email" with value "john.doe@company.com"
    And i want to create a password token for "customer"
    Then the path should be "customers/password-token"
    And the method should be "POST"
    And the request should be
    """
    {
      "email": "john.doe@company.com"
    }
    """

  Scenario: Get customer by password token
    Given i have the "token" with value "tokenValue"
    Given i want to fetch a "Customer" by token
    Then the path should be "customers?token=tokenValue"
    And the method should be "GET"

  Scenario: Reset customers password
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i have the "tokenValue" with value "token"
    And i have the "newPassword" with value "newPassword"
    And i "reset" the "customer" password
    Then the path should be "customers/password/reset"
    And the method should be "POST"
    And the request should be
    """
    {
      "id": "id",
      "version": "version",
      "tokenValue": "token",
      "newPassword": "newPassword"
    }
    """

  Scenario: Change the customers password
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i have the "currentPassword" with value "currentPassword"
    And i have the "newPassword" with value "newPassword"
    And i "change" the "customer" password
    Then the path should be "customers/password"
    And the method should be "POST"
    And the request should be
    """
    {
      "id": "id",
      "version": "version",
      "currentPassword": "currentPassword",
      "newPassword": "newPassword"
    }
    """

