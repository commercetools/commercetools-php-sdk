Feature: I want to create custom objects
  Scenario: create a new custom object
    Given i have a "CustomObject" draft with values
    """
    {
      "container": "myNamespace",
      "key": "myKey",
      "value": "myValue"
    }
    """
    When i want to create a "customObject"
    Then the path should be "custom-objects"
    And the method should be "POST"
    And the request should be
    """
    {
      "container": "myNamespace",
      "key": "myKey",
      "value": "myValue"
    }
    """

  Scenario: update a new custom object
    Given i have a "CustomObject" draft with values
    """
    {
      "container": "myNamespace",
      "key": "myKey",
      "value": "myValue",
      "version": 1
    }
    """
    When i want to create a "customObject"
    Then the path should be "custom-objects"
    And the method should be "POST"
    And the request should be
    """
    {
      "container": "myNamespace",
      "key": "myKey",
      "value": "myValue",
      "version": 1
    }
    """
