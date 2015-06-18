Feature: I want to create a new zone
  Background:
    Given i have a state stateReference object as stateReference
    And the id is "my-state-id"
    Given i have a state draft
    And the key is "myState"
    And the type is "LineItemState"
    And set the name to "My State" in en
    And set the description to "My State Description" in en
    And set the initial to 0 as bool
    And add the StateReference object to transitions collection

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
