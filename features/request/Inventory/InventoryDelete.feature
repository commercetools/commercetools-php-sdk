Feature: I want to delete an inventory
  Scenario: Delete inventory
    Given a "inventory" is identified by "id" and "version"
    And i want to delete a "inventory"
    Then the path should be "inventory/id?version=version"
    And the method should be "DELETE"
