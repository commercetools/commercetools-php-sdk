@ignore
Feature: I want to update a cart
  Background:
    Given a "cart" is identified by "id" and "version"
    Given i have a "common" "money" object as "money"
    And the "currency" is "EUR"
    And the "centAmount" is "300" as "int"
    Given i have a "TaxCategory" "TaxRate" object as "TaxRate"
    And set the "name" to "default"
    And set the "amount" to "0.19" as float
    Given i have a "TaxCategory" "TaxCategory" object as "TaxCategory"
    And set the "name" to "Mwst"
    And add the "TaxRate" object to "rates" collection
  Scenario: Add a line item
    Given i want to "addLineItem" of "cart"
    And the productId is "productId-1"
    And the variantId is "variantId-1"
    And the quantity is "3" as "int"
    When i want to update a "Cart"
    Then the path should be "carts/id"
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
          "quantity": 3
        }
      ]
    }
    """

  Scenario: Remove a line item
    Given i want to "removeLineItem" of "cart"
    And the lineItemId is "lineItemId-1"
    And set the quantity to "3" as "int"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "removeLineItem",
          "lineItemId": "lineItemId-1",
          "quantity": 3
        }
      ]
    }
    """

  Scenario: Change a line item quantity
    Given i want to "changeLineItemQuantity" of "cart"
    And the lineItemId is "lineItemId-1"
    And the quantity is "3" as "int"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeLineItemQuantity",
          "lineItemId": "lineItemId-1",
          "quantity": 3
        }
      ]
    }
    """

  Scenario: Add a custom line item
    Given i want to "addCustomLineItem" of "cart"
    And the name is "customLineItem" in "en"
    And the quantity is "3" as "int"
    And set the "money" object to "money"
    And the slug is "my-custom-line-item"
    And set the "taxCategory" object to "taxCategory"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addCustomLineItem",
          "name": {
            "en": "customLineItem"
          },
          "quantity": 3,
          "money": {
            "currencyCode": "EUR",
            "centAmount": 300
          },
          "slug": "my-custom-line-item",
          "taxCategory": {
            "name": "Mwst",
            "rates": [
              {
                "name": "default",
                "amount": 0.19
              }
            ]
          }
        }
      ]
    }
    """

  Scenario: Remove a custom line item
    Given i want to "removeCustomLineItem" of "cart"
    And the customLineItemId is "customLineItem-1"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "removeCustomLineItem",
          "customLineItemId": "customLineItem-1"
        }
      ]
    }
    """

  Scenario: Set customer email
    Given i want to "setCustomerEmail" of "cart"
    And set the email to "john.doe@company.com"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setCustomerEmail",
          "email": "john.doe@company.com"
        }
      ]
    }
    """
