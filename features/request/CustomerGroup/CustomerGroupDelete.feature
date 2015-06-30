Feature: I want to delete a customer group
  Scenario: Delete customer group
    Given a "customerGroup" is identified by "id" and "version"
    And i want to delete a "customerGroup"
    Then the path should be "customer-groups/id?version=version"
    And the method should be "DELETE"
