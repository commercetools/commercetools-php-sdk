Feature: I want to delete a custom object
  Scenario: Delete custom object
    Given a "customObject" is identified by "container" and key "key"
    And i want to delete a "customObject" by container and key
    Then the path should be "custom-objects/container/key"
    And the method should be "DELETE"
