Feature: I want to update a channel
  Scenario: Empty update
    Given a "channel" is identified by "id" and version 1
    And i want to update a "channel"
    Then the path should be "channels/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: change channel key
    Given a "channel" is identified by "id" and version 1
    And i want to update a "channel"
    And add the "changeKey" action to "channel" with values
    """
    {
      "action": "changeKey",
      "key": "NewChannelKey"
    }
    """
    Then the path should be "channels/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeKey",
          "key": "NewChannelKey"
        }
      ]
    }
    """

  Scenario: change channel name
    Given a "channel" is identified by "id" and version 1
    And i want to update a "channel"
    And add the "changeName" action to "channel" with values
    """
    {
      "action": "changeName",
      "name": {
        "en": "New channel name"
      }
    }
    """
    Then the path should be "channels/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeName",
          "name": {
            "en": "New channel name"
          }
        }
      ]
    }
    """

  Scenario: change channel description
    Given a "channel" is identified by "id" and version 1
    And i want to update a "channel"
    And add the "changeDescription" action to "channel" with values
    """
    {
      "action": "changeDescription",
      "description": {
        "en": "New channel description"
      }
    }
    """
    Then the path should be "channels/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeDescription",
          "description": {
            "en": "New channel description"
          }
        }
      ]
    }
    """

  Scenario: set channel roles
    Given a "channel" is identified by "id" and version 1
    And i want to update a "channel"
    And add the "setRoles" action to "channel" with values
    """
    {
      "action": "setRoles",
      "roles": ["InventorySupply","Primary"]
    }
    """
    Then the path should be "channels/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setRoles",
          "roles": ["InventorySupply", "Primary"]
        }
      ]
    }
    """

  Scenario: add channel roles
    Given a "channel" is identified by "id" and version 1
    And i want to update a "channel"
    And add the "addRoles" action to "channel" with values
    """
    {
      "action": "addRoles",
      "roles": ["InventorySupply"]
    }
    """
    Then the path should be "channels/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addRoles",
          "roles": ["InventorySupply"]
        }
      ]
    }
    """

  Scenario: remove channel roles
    Given a "channel" is identified by "id" and version 1
    And i want to update a "channel"
    And add the "removeRoles" action to "channel" with values
    """
    {
      "action": "removeRoles",
      "roles": ["InventorySupply"]
    }
    """
    Then the path should be "channels/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeRoles",
          "roles": ["InventorySupply"]
        }
      ]
    }
    """
