Feature: I want to confirm a customer's email
  Scenario: Create Token for confirmation
    Given a "customer" is identified by "id" and version 1
    And i want to create a "Customer" token with "10" minutes ttl
    Then the path should be "customers/email-token"
    And the method should be "POST"
    And the request should be
    """
    {
      "id": "id",
      "version": 1,
      "ttlMinutes": 10
    }
    """

  Scenario: Confirm Token for email change
    Given a "customer" is identified by "id" and version 1
    Given i want to confirm the "Customer" email with token "token"
    Then the path should be "customers/email/confirm"
    And the method should be "POST"
    And the request should be
    """
    {
      "id": "id",
      "version": 1,
      "tokenValue": "token"
    }
    """
