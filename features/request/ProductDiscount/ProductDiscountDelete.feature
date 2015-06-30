Feature: I want to delete a product discount
  Scenario: Delete product discount
    Given a "productDiscount" is identified by "id" and "version"
    And i want to delete a "productDiscount"
    Then the path should be "product-discounts/id?version=version"
    And the method should be "DELETE"
