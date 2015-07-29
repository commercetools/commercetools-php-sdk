Feature: I want to delete a cart
  Scenario: Delete cart
    Given a "cart" is identified by "id" and version "1"
    And i want to delete a "Cart"
    Then the path should be "carts/id?version=1"
    And the method should be "DELETE"
