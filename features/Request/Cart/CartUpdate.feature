@ignore
Feature: I want to update a cart
  Scenario: Add a line item
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i want to update a "Cart"
    And i have the "productId" with value "productId-1"
    And i have the "variantId" with value "variantId-1"
    And i have the "quantity" with value "3"
    When i "add" the "LineItem" with these values
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addLineItem",
          "productId": "productId-1",
          "variantId": "variantId-1",
          "quantity": "3"
        }
      ]
    }
    """

  Scenario: Remove a line item
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i want to update a "Cart"
    And i have the "lineItemId" with value "lineItemId-1"
    And i have the "quantity" with value "3"
    When i "add" the "LineItem" with these values
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addLineItem",
          "lineItemId": "lineItemId-1",
          "quantity": "3"
        }
      ]
    }
    """
