Feature: I want to delete a product
  Scenario: Delete product
    Given a "product" is identified by "id" and version 1
    And i want to delete a "product"
    Then the path should be "/products/id?version=1"
    And the method should be "DELETE"
