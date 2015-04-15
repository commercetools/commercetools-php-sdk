Feature: I want to delete a category
  Scenario: Delete category
    Given a "category" is identified by "id" and "version"
    And i want to delete a "category"
    Then the path should be "categories/id?version=version"
    And the method should be "DELETE"
