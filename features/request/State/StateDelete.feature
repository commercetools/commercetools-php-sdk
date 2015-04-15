Feature: I want to delete a state
  Scenario: Delete state
    Given a "state" is identified by "id" and "version"
    And i want to delete a "state"
    Then the path should be "states/id?version=version"
    And the method should be "DELETE"
