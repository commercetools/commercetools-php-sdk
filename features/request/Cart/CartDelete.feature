Feature: I want to delete a cart
  Scenario: Delete cart
    Given a "cart" is identified by "id" and "version"
    And i want to delete a "Cart"
    Then the path should be "carts/id?version=version"
    And the method should be "DELETE"
