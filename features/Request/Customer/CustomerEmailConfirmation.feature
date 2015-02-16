Feature: I want to confirm a customer's email
  Scenario: Create Token for confirmation
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i have the "ttlMinutes" with value "ttl"
    And i want to create a "Customer" token
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
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i have the "tokenValue" with value "token"
    Given i want to confirm a "Customer" token
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
