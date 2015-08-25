Feature: I want to delete a type
  Scenario: Delete type
    Given a "type" is identified by "id" and version 1
    And i want to delete a "type"
    Then the path should be "types/id?version=1"
    And the method should be "DELETE"
