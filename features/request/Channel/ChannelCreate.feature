Feature: I want to create a new channel
  Background:
    Given i have a "channel" draft with values
    """
    {
      "key": "my-channel",
      "roles": ["InventorySupply", "Primary"],
      "name": {
        "en": "myChannel"
      },
      "description": {
        "en": "My Channel"
      }
    }
    """

  Scenario: create a channel
    When i want to create a "channel"
    Then the path should be "channels"
    And the method should be "POST"
    And the request should be
    """
    {
      "key": "my-channel",
      "roles": ["InventorySupply", "Primary"],
      "name": {
        "en": "myChannel"
      },
      "description": {
        "en": "My Channel"
      }
    }
    """
