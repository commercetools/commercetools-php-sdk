Feature: I want to change the customer's password
  Scenario: Create Token for password change
    Given a "customer" is identified by the email "john.doe@example.org"
    And i want to create a password token for "customer"
    Then the path should be "/customers/password-token"
    And the method should be "POST"
    And the request should be
    """
    {
      "email": "john.doe@example.org"
    }
    """

  Scenario: Get customer by password token
    Given a "customer" is identified by the token "tokenValue"
    Given i want to fetch a "Customer" by token
    Then the path should be "/customers?token=tokenValue"
    And the method should be "GET"

  Scenario: Reset customers password
    Given a "customer" is identified by "id" and version 1
    And i want to reset the "customer" password to "newPassword" with token "token"
    Then the path should be "/customers/password/reset"
    And the method should be "POST"
    And the request should be
    """
    {
      "id": "id",
      "version": 1,
      "tokenValue": "token",
      "newPassword": "newPassword"
    }
    """

  Scenario: Change the customers password
    Given a "customer" is identified by "id" and version 1
    And i want to change the "customer" password from "currentPassword" to "newPassword"
    Then the path should be "/customers/password"
    And the method should be "POST"
    And the request should be
    """
    {
      "id": "id",
      "version": 1,
      "currentPassword": "currentPassword",
      "newPassword": "newPassword"
    }
    """

