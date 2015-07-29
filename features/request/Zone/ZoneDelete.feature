Feature: I want to delete a zone
  Scenario: Delete zone
    Given a "zone" is identified by "id" and version 1
    And i want to delete a "zone"
    Then the path should be "zones/id?version=1"
    And the method should be "DELETE"
