Feature: I want to update a customer group
  Scenario: Empty update
    Given a "customerGroup" is identified by "id" and version 1
    Given i want to update a "customerGroup"
    Then the path should be "customer-groups/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: Change Name
    Given a "customerGroup" is identified by "id" and version 1
    Given i want to update a "customerGroup"
    And add the "changeName" action to "customerGroup" with values
    """
    {
      "action": "changeName",
      "name": "New group name"
    }
    """
    Then the path should be "customer-groups/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeName",
          "name": "New group name"
        }
      ]
    }
    """
