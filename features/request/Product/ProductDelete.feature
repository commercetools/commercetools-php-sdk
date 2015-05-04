Feature: I want to delete a product
  Scenario: Delete product
    Given a "product" is identified by "id" and "version"
    And i want to delete a "product"
    Then the path should be "products/id?version=version"
    And the method should be "DELETE"
