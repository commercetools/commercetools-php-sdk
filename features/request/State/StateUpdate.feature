Feature: I want to update a state
  Background:
    Given a "state" is identified by "id" and "version"
  Scenario: Empty update
    Given i want to update a "state"
    Then the path should be "states/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
      ]
    }
    """
