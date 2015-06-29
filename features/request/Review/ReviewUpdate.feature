Feature: I want to update a review
  Background:
    Given a "review" is identified by "id" and version 1
  Scenario: Empty update
    Given i want to update a "review"
    Then the path should be "/reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """
