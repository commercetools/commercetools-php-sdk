Feature: I want to delete a product discount
  Scenario: Delete product discount
    Given a "productDiscount" is identified by "id" and version 1
    And i want to delete a "productDiscount"
    Then the path should be "product-discounts/id?version=1"
    And the method should be "DELETE"
