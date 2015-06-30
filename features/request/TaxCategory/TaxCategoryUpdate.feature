Feature: I want to update a tax category
  Background:
    Given a "taxCategory" is identified by "id" and version 1
  Scenario: Empty update
    Given i want to update a "taxCategory"
    Then the path should be "tax-categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """
