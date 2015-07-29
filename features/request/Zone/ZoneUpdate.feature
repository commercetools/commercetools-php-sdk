Feature: I want to update a zone
  Scenario: Empty update
    Given a "zone" is identified by "id" and version 1
    And i want to update a "zone"
    Then the path should be "zones/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: Change name
    Given a "zone" is identified by "id" and version 1
    And i want to update a "zone"
    And add the "changeName" action to "zone" with values
    """
    {
      "action": "changeName",
      "name": "New zone name"
    }
    """
    Then the path should be "zones/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeName",
          "name": "New zone name"
        }
      ]
    }
    """

  Scenario: Set description
    Given a "zone" is identified by "id" and version 1
    And i want to update a "zone"
    And add the "setDescription" action to "zone" with values
    """
    {
      "action": "setDescription",
      "description": "New description"
    }
    """
    Then the path should be "zones/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDescription",
          "description": "New description"
        }
      ]
    }
    """

  Scenario: Add location
    Given a "zone" is identified by "id" and version 1
    And i want to update a "zone"
    And add the "addLocation" action to "zone" with values
    """
    {
      "action": "addLocation",
      "location": {
        "country": "DE",
        "state": "Berlin"
      }
    }
    """
    Then the path should be "zones/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addLocation",
          "location": {
            "country": "DE",
            "state": "Berlin"
          }
        }
      ]
    }
    """

  Scenario: Remove location
    Given a "zone" is identified by "id" and version 1
    And i want to update a "zone"
    And add the "removeLocation" action to "zone" with values
    """
    {
      "action": "removeLocation",
      "location": {
        "country": "DE",
        "state": "Berlin"
      }
    }
    """
    Then the path should be "zones/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeLocation",
          "location": {
            "country": "DE",
            "state": "Berlin"
          }
        }
      ]
    }
    """
