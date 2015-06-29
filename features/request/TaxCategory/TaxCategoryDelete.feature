Feature: I want to delete a tax category
  Scenario: Delete tax category
    Given a "taxCategory" is identified by "id" and version 1
    And i want to delete a "taxCategory"
    Then the path should be "/tax-categories/id?version=1"
    And the method should be "DELETE"
