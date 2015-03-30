Feature: I want to update a inventory
  Background:
    Given a "inventory" is identified by "id" and "version"
  Scenario: Empty update
    Given i want to update a "inventory"
    Then the path should be "inventory/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
      ]
    }
    """
