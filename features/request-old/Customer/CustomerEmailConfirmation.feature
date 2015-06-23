Feature: I want to confirm a customer's email
  Scenario: Create Token for confirmation
    Given a "customer" is identified by "id" and "version"
    And the "ttlMinutes" is "ttl"
    And i want to create a "Customer" token
    Then the path should be "/customers/email-token"
    And the method should be "POST"
    And the request should be
    """
    {
      "id": "id",
      "version": "version",
      "ttlMinutes": "ttl"
    }
    """

  Scenario: Confirm Token for email change
    Given a "customer" is identified by "id" and "version"
    And the "tokenValue" is "token"
    Given i want to confirm a "Customer" token
    Then the path should be "/customers/email/confirm"
    And the method should be "POST"
    And the request should be
    """
    {
      "id": "id",
      "version": "version",
      "tokenValue": "token"
    }
    """
