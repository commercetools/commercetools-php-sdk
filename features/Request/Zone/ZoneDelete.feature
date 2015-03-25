Feature: I want to delete a zone
  Scenario: Delete zone
    Given a "zone" is identified by "id" and "version"
    And i want to delete a "zone"
    Then the path should be "zones/id?version=version"
    And the method should be "DELETE"
