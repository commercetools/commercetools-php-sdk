Feature: I want to confirm a customer's email
  Scenario: Create Token for confirmation
    Given i want to create a "Customer" token identified by "id" and at version "version" with "ttl" minutes lifetime
    Then the path should be "customers/email-token"
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
    Given i want to confirm a "Customer" token identified by "id" and at version "version" with "token" value
    Then the path should be "customers/email/confirm"
    And the method should be "POST"
    And the request should be
    """
    {
      "id": "id",
      "version": "version",
      "tokenValue": "token"
    }
    """
