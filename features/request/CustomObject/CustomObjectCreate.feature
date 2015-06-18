Feature: I want to create custom objects
  Scenario: create a new custom object
    Given i have a "customObject" "CustomObject" object as "CustomObject"
    And set the container to "myNamespace"
    And set the key to "myKey"
    And set the value to "myValue"
    When i want to create a "customObject"
    Then the path should be "/custom-objects"
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
    Given i have a "customObject" "CustomObject" object as "CustomObject"
    And set the container to "myNamespace"
    And set the key to "myKey"
    And set the value to "myValue"
    And set the version to 1 as int
    When i want to create a "customObject"
    Then the path should be "/custom-objects"
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
