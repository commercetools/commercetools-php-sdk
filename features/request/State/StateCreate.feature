Feature: I want to create a new zone
  Background:
    Given i have a "state" draft with values
    """
    {
      "key": "myState",
      "type": "LineItemState",
      "name": {
        "en": "My State"
      },
      "description": {
        "en": "My State Description"
      },
      "initial": false,
      "transitions": [
        {
          "typeId": "state",
          "id": "my-state-id"
        }
      ]
    }
    """

  Scenario: create a zone
    When i want to create a "state"
    Then the path should be "/states"
    And the method should be "POST"
    And the request should be
    """
    {
      "key": "myState",
      "type": "LineItemState",
      "name": {
        "en": "My State"
      },
      "description": {
        "en": "My State Description"
      },
      "initial": false,
      "transitions": [
        {
          "typeId": "state",
          "id": "my-state-id"
        }
      ]
    }
    """
