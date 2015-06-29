Feature: I want to delete a cart discount
  Scenario: Delete cart discount
    Given a "cartDiscount" is identified by "id" and version 1
    And i want to delete a "CartDiscount"
    Then the path should be "/cart-discounts/id?version=1"
    And the method should be "DELETE"
