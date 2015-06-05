Feature: I want to update a customer group
  Background:
    Given a "customerGroup" is identified by "id" and "version"
  Scenario: Empty update
    Given i want to update a "customerGroup"
    Then the path should be "/customer-groups/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
      ]
    }
    """
