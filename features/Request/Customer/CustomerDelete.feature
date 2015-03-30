Feature: I want to delete a customer
  Background:
    Given a "category" is identified by "id" and "version"

  Scenario: Delete customer
    Given a "customer" is identified by "id" and "version"
    And i want to delete a "Customer"
    Then the path should be "customers/id?version=version"
    And the method should be "DELETE"
