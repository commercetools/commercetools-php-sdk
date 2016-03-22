Feature: I want to delete a type
  Scenario: Delete type
    Given a "type" is identified by "id" and version 1
    And i want to delete a "type"
    Then the path should be "types/id?version=1"
    And the method should be "DELETE"

  Scenario: Delete type
    Given a "type" is identified by "typeKey" and version 1
    And i want to delete a "type" by key
    Then the path should be "types/key=typeKey?version=1"
    And the method should be "DELETE"
