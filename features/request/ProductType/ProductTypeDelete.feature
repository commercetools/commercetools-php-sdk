Feature: I want to delete a product type
  Scenario: Delete product type
    Given a "productType" is identified by "id" and version 1
    And i want to delete a "productType"
    Then the path should be "product-types/id?version=1"
    And the method should be "DELETE"
