Feature: I want to update a inventory
  Scenario: Empty update
    Given a "inventory" is identified by "id" and version 1
    And i want to update a "inventory"
    Then the path should be "inventory/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: Add Quantity
    Given a "inventory" is identified by "id" and version 1
    And i want to update a "inventory"
    And add the "addQuantity" action to "inventory" with values
    """
    {
      "action": "addQuantity",
      "quantity": 10
    }
    """
    Then the path should be "inventory/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addQuantity",
          "quantity": 10
        }
      ]
    }
    """

  Scenario: Remove Quantity
    Given a "inventory" is identified by "id" and version 1
    And i want to update a "inventory"
    And add the "removeQuantity" action to "inventory" with values
    """
    {
      "action": "removeQuantity",
      "quantity": 10
    }
    """
    Then the path should be "inventory/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeQuantity",
          "quantity": 10
        }
      ]
    }
    """

  Scenario: Change Quantity
    Given a "inventory" is identified by "id" and version 1
    And i want to update a "inventory"
    And add the "changeQuantity" action to "inventory" with values
    """
    {
      "action": "changeQuantity",
      "quantity": 10
    }
    """
    Then the path should be "inventory/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeQuantity",
          "quantity": 10
        }
      ]
    }
    """

  Scenario: Set RestockableInDays
    Given a "inventory" is identified by "id" and version 1
    And i want to update a "inventory"
    And add the "setRestockableInDays" action to "inventory" with values
    """
    {
      "action": "setRestockableInDays",
      "restockableInDays": 10
    }
    """
    Then the path should be "inventory/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setRestockableInDays",
          "restockableInDays": 10
        }
      ]
    }
    """

  Scenario: Set ExpectedDelivery
    Given a "inventory" is identified by "id" and version 1
    And i want to update a "inventory"
    And add the "setExpectedDelivery" action to "inventory" with values
    """
    {
      "action": "setExpectedDelivery",
      "expectedDelivery": "2012-05-15 13:00:00+01:00"
    }
    """
    Then the path should be "inventory/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setExpectedDelivery",
          "expectedDelivery": "2012-05-15T12:00:00+00:00"
        }
      ]
    }
    """
