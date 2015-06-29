Feature: I want to delete a state
  Scenario: Delete state
    Given a "state" is identified by "id" and version 1
    And i want to delete a "state"
    Then the path should be "/states/id?version=1"
    And the method should be "DELETE"
