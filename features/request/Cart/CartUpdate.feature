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
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "setCustomerEmail" action to "cart" with values
    """
        {
          "action": "setCustomerEmail",
          "email": "john.doe@company.com"
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
          "action": "setCustomerEmail",
          "email": "john.doe@company.com"
        }
      ]
    }
    """

  Scenario: Set shipping address
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "setShippingAddress" action to "cart" with values
    """
        {
          "action": "setShippingAddress",
          "address": {
            "email": "john.doe@company.com",
            "firstName": "John",
            "lastName": "Doe"
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
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "setBillingAddress" action to "cart" with values
    """
        {
          "action": "setBillingAddress",
          "address": {
            "email": "john.doe@company.com",
            "firstName": "John",
            "lastName": "Doe"
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
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "setCountry" action to "cart" with values
    """
        {
          "action": "setCountry",
          "country": "DE"
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
          "action": "setCountry",
          "country": "DE"
        }
      ]
    }
    """



  Scenario: Set CustomerId
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "setCustomerId" action to "cart" with values
    """
        {
          "action": "setCustomerId",
          "customerId": "customer-1"
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
          "action": "setCustomerId",
          "customerId": "customer-1"
        }
      ]
    }
    """

  Scenario: Add discount code
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "addDiscountCode" action to "cart" with values
    """
        {
          "action": "addDiscountCode",
          "code": "payless"
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
          "action": "addDiscountCode",
          "code": "payless"
        }
      ]
    }
    """

  Scenario: Recalculate cart
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "recalculate" action to "cart" with values
    """
        {
          "action": "recalculate"
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
          "action": "recalculate"
        }
      ]
    }
    """

  Scenario: Set Shipping Method
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "setShippingMethod" action to "cart" with values
    """
        {
          "action": "setShippingMethod",
          "shippingMethod": {
            "typeId": "shipping-method",
            "id": "myShippingMethod"
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
    Given a "cart" is identified by "id" and version "1"
    And i want to update a "Cart"
    And add the "removeDiscountCode" action to "cart" with values
    """
        {
          "action": "removeDiscountCode",
          "discountCode": {
            "typeId": "discount-code",
            "id": "payless"
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
          "action": "removeDiscountCode",
          "discountCode": {
            "typeId": "discount-code",
            "id": "payless"
          }
        }
      ]
    }
    """
