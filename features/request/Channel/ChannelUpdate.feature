Feature: I want to update a channel
  Background:
    Given a "channel" is identified by "id" and version 1
  Scenario: Empty update
    Given i want to update a "channel"
    Then the path should be "/channels/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """
