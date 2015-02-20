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
    Given i have a "common" "address" object as "default"
    And set the firstName to "John"
    And set the lastName to "Doe"
    And set the email to "john.doe@company.com"
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
    And the "money" is "money" object
    And the slug is "my-custom-line-item"
    And the "taxCategory" is "taxCategory" object
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

  Scenario: Set shipping address
    Given i want to "setShippingAddress" of "cart"
    And set the "default" object to "address"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setShippingAddress",
          "address": {
            "email": "john.doe@company.com",
            "firstName": "John",
            "lastName": "Doe"
          }
        }
      ]
    }
    """

  Scenario: Set billing address
    Given i want to "setBillingAddress" of "cart"
    And set the "default" object to "address"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setBillingAddress",
          "address": {
            "email": "john.doe@company.com",
            "firstName": "John",
            "lastName": "Doe"
          }
        }
      ]
    }
    """

  Scenario: Set country
    Given i want to "setCountry" of "cart"
    And set the country to "DE"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setCountry",
          "country": "DE"
        }
      ]
    }
    """



  Scenario: Set CustomerId
    Given i want to "setCustomerId" of "cart"
    And set the "customerId" to "customer-1"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setCustomerId",
          "customerId": "customer-1"
        }
      ]
    }
    """

  Scenario: Add discount code
    Given i want to "addDiscountCode" of "cart"
    And the "code" is "payless"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addDiscountCode",
          "code": "payless"
        }
      ]
    }
    """

  Scenario: Recalculate cart
    Given i want to "recalculate" of "cart"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "recalculate"
        }
      ]
    }
    """

  Scenario: Set Shipping Method
    Given i want to "setShippingMethod" of "cart"
    And set the "shippingMethod" reference "shippingMethod" to "myShippingMethod"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setShippingMethod",
          "shippingMethod": {
            "typeId": "shipping-method",
            "id": "myShippingMethod"
          }
        }
      ]
    }
    """

  Scenario: Remove discount code
    Given i want to "removeDiscountCode" of "cart"
    And the "discountCode" reference "discountCode" is "payless"
    When i want to update a "Cart"
    Then the path should be "carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "removeDiscountCode",
          "discountCode": {
            "typeId": "discount-code",
            "id": "payless"
          }
        }
      ]
    }
    """
