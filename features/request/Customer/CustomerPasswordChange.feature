Feature: I want to change the customer's password
  Scenario: Create Token for password change
    Given a "customer" is identified by the email "john.doe@company.com"
    And i want to create a password token for "customer"
    Then the path should be "/customers/password-token"
    And the method should be "POST"
    And the request should be
    """
    {
      "email": "john.doe@company.com"
    }
    """

  Scenario: Get customer by password token
    Given a "customer" is identified by the token "tokenValue"
    Given i want to fetch a "Customer" by token
    Then the path should be "/customers?token=tokenValue"
    And the method should be "GET"

  Scenario: Reset customers password
    Given a "customer" is identified by "id" and "version"
    And the "tokenValue" is "token"
    And the "newPassword" is "newPassword"
    And i "reset" the "customer" password
    Then the path should be "/customers/password/reset"
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
    Given a "customer" is identified by "id" and "version"
    And the "currentPassword" is "currentPassword"
    And the "newPassword" is "newPassword"
    And i "change" the "customer" password
    Then the path should be "/customers/password"
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

