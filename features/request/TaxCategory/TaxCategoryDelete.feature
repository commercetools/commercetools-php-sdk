Feature: I want to delete a tax category
  Scenario: Delete tax category
    Given a "taxCategory" is identified by "id" and "version"
    And i want to delete a "taxCategory"
    Then the path should be "/tax-categories/id?version=version"
    And the method should be "DELETE"
