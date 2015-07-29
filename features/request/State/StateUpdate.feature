Feature: I want to update a state
  Scenario: Empty update
    Given a "state" is identified by "id" and version 1
    And i want to update a "state"
    Then the path should be "states/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: change state key
    Given a "state" is identified by "id" and version 1
    And i want to update a "state"
    And add the "changeKey" action to "state" with values
    """
    {
      "action": "changeKey",
      "key": "new_key"
    }
    """
    Then the path should be "states/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeKey",
          "key": "new_key"
        }
      ]
    }
    """

  Scenario: set state name
    Given a "state" is identified by "id" and version 1
    And i want to update a "state"
    And add the "setName" action to "state" with values
    """
    {
      "action": "setName",
      "name": {
        "en": "New state name"
      }
    }
    """
    Then the path should be "states/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setName",
          "name": {
            "en": "New state name"
          }
        }
      ]
    }
    """

  Scenario: set state description
    Given a "state" is identified by "id" and version 1
    And i want to update a "state"
    And add the "setDescription" action to "state" with values
    """
    {
      "action": "setDescription",
      "description": {
        "en": "New state description"
      }
    }
    """
    Then the path should be "states/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDescription",
          "description": {
            "en": "New state description"
          }
        }
      ]
    }
    """

  Scenario: change state tyoe
    Given a "state" is identified by "id" and version 1
    And i want to update a "state"
    And add the "changeType" action to "state" with values
    """
    {
      "action": "changeType",
      "type": "LineItemState"
    }
    """
    Then the path should be "states/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeType",
          "type": "LineItemState"
        }
      ]
    }
    """

  Scenario: change initial state
    Given a "state" is identified by "id" and version 1
    And i want to update a "state"
    And add the "changeInitial" action to "state" with values
    """
    {
      "action": "changeInitial",
      "initial": true
    }
    """
    Then the path should be "states/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeInitial",
          "initial": true
        }
      ]
    }
    """

  Scenario: set transitions
    Given a "state" is identified by "id" and version 1
    And i want to update a "state"
    And add the "setTransitions" action to "state" with values
    """
    {
      "action": "setTransitions",
      "transitions": [
        {
          "typeId": "state",
          "id": "<state-id>"
        }
      ]
    }
    """
    Then the path should be "states/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setTransitions",
          "transitions": [
            {
              "typeId": "state",
              "id": "<state-id>"
            }
          ]
        }
      ]
    }
    """
