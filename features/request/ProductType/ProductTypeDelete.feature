Feature: I want to delete a product type
  Scenario: Delete product type
    Given a "productType" is identified by "id" and "version"
    And i want to delete a "productType"
    Then the path should be "product-types/id?version=version"
    And the method should be "DELETE"
