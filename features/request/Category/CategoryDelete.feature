Feature: I want to delete a category
  Scenario: Delete category
    Given a "category" is identified by "id" and version 1
    And i want to delete a "category"
    Then the path should be "/categories/id?version=1"
    And the method should be "DELETE"
