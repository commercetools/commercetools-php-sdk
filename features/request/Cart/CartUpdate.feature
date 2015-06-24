Feature: I want to update a cart

  Scenario: Add a line item
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "cart"
    And add the "addLineItem" action to "cart" with values
    """
    {
      "action": "addLineItem",
      "productId": "productId-1",
      "variantId": 1,
      "quantity": 3
    }
    """
    Then the path should be "/carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addLineItem",
          "productId": "productId-1",
          "variantId": 1,
          "quantity": 3
        }
      ]
    }
    """

  Scenario: Remove a line item
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "removeLineItem" action to "cart" with values
    """
    {
      "action": "removeLineItem",
      "lineItemId": "lineItemId-1",
      "quantity": 3
    }
    """
    Then the path should be "/carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "changeLineItemQuantity" action to "cart" with values
    """
    {
      "action": "changeLineItemQuantity",
      "lineItemId": "lineItemId-1",
      "quantity": 3
    }
    """
    Then the path should be "/carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "addCustomLineItem" action to "cart" with values
    """
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
    """
    Then the path should be "/carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "removeCustomLineItem" action to "cart" with values
    """
        {
          "action": "removeCustomLineItem",
          "customLineItemId": "customLineItem-1"
        }
    """
    Then the path should be "/carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Then the path should be "/carts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Then the path should be "/carts/id"
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
    Then the path should be "/carts/id"
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
    Then the path should be "/carts/id"
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
    Then the path should be "/carts/id"
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
    Then the path should be "/carts/id"
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
    Then the path should be "/carts/id"
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
    Then the path should be "/carts/id"
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
    Then the path should be "/carts/id"
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
