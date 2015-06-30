Feature: I want to update a comment
  Background:
    Given a "comment" is identified by "id" and version 1
  Scenario: Empty update
    Given i want to update a "comment"
    Then the path should be "comments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """
