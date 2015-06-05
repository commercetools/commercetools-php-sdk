Feature: I want to import a new order
  Background:
    Given i have a "order" "importProductVariant" object as "variant"
    And set the "id" to 1 as int
    And set the "sku" to "product-123-1"
    Given i have a "common" "money" object as "variantMoney"
    And the "currencyCode" is "EUR"
    And the "centAmount" is "1000" as "int"
    Given i have a "common" "price" object as "price"
    And the "value" is "variantMoney" object
    Given i have a "order" "itemState" object as "itemState"
    And set the "quantity" to 1 as "int"
    And set the "state" reference "state" to "state-123"
    Given i have a "taxCategory" "taxRate" object as "taxRate"
    And set the "name" to "Mwst 19%"
    And set the "amount" to "0.19" as "float"
    And set the "country" to "DE"
    Given i have a "order" "importLineItem" object as "lineItem"
    And set the "productId" to "product-123"
    And set the "name" to "Product-123" in "en"
    And set the "variant" object to "variant"
    And set the "price" object to "price"
    And set the "quantity" to 1 as "int"
    And add the itemState object to state collection
    And set the "channel" reference "supplyChannel" to "provider-123"
    And set the "taxRate" object to "taxRate"
    Given i have a "common" "money" object as "totalPrice"
    And the currencyCode is "EUR"
    And the centAmount is "1000" as "int"
    Given i have a "common" "money" object as "totalNet"
    And the currencyCode is "EUR"
    And the centAmount is "810" as "int"
    Given i have a "common" "money" object as "totalGross"
    And the currencyCode is "EUR"
    And the centAmount is "1000" as "int"
    Given i have a "common" "money" object as "taxAmount"
    And the currencyCode is "EUR"
    And the centAmount is "190" as "int"
    Given i have a "common" "taxPortion" object as "taxPortion"
    And set the rate to "0.19" as "float"
    And set the "taxAmount" object to "amount"
    Given i have a "common" "taxedPrice" object as "taxedPrice"
    And set the "totalNet" object to "totalNet"
    And set the "totalGross" object to "totalGross"
    And add the "taxPortion" object to "taxPortions" collection
    Given i have a "common" "address" object as "shippingAddress"
    And set the "firstName" to "John"
    And set the "lastName" to "Doe"
    Given i have a "common" "address" object as "billingAddress"
    And set the "firstName" to "John"
    And set the "lastName" to "Doe"
    Given i have a "cart" "shippingInfo" object as "shippingInfo"
    And set the "shippingMethodName" to "DHL"
    Given i have a "order" "importOrder" object as "order"
    And set the "orderNumber" to 12345
    And set the "customerId" to abc
    And set the "customerEmail" to "john.doe@company.com"
    And add the "lineItem" object to "lineItems" collection
    And set the "totalPrice" object to totalPrice
    And set the "taxedPrice" object to taxedPrice
    And set the "shippingAddress" object to "shippingAddress"
    And set the "billingAddress" object to "billingAddress"
    And set the "customerGroup" reference "customerGroup" to "myCustomerGroup"
    And set the country to "DE"
    And set the orderState to "Open"
    And set the shipmentState to "Pending"
    And set the paymentState to "Pending"
    And set the "shippingInfo" object to "shippingInfo"
    And set the "completedAt" date to "2015-05-01T15:20Z"

  Scenario: import an order from cart
    Given i want to import a "order"
    Then the path should be "/orders/import"
    And the method should be "POST"
    And the request should be
    """
    {
      "orderNumber": "12345",
      "customerId": "abc",
      "customerEmail": "john.doe@company.com",
      "lineItems": [
        {
          "productId": "product-123",
          "name": {
            "en": "Product-123"
          },
          "variant": {
            "id": 1,
            "sku": "product-123-1"
          },
          "price": {
            "value": {
              "currencyCode": "EUR",
              "centAmount": 1000
            }
          },
          "quantity": 1,
          "state": [
            {
              "quantity": 1,
              "state": {
                "typeId": "state",
                "id": "state-123"
              }
            }
          ],
          "supplyChannel": {
            "typeId": "channel",
            "id": "provider-123"
          },
          "taxRate": {
            "name": "Mwst 19%",
            "amount": 0.19,
            "country": "DE"
          }
        }
      ],
      "totalPrice": {
        "currencyCode": "EUR",
        "centAmount": 1000
      },
      "taxedPrice": {
        "totalNet": {
          "currencyCode": "EUR",
          "centAmount": 810
        },
        "totalGross": {
          "currencyCode": "EUR",
          "centAmount": 1000
        },
        "taxPortions": [
          {
            "rate": 0.19,
            "amount": {
              "currencyCode": "EUR",
              "centAmount": 190
            }
          }
        ]
      },
      "shippingAddress": {
        "firstName": "John",
        "lastName": "Doe"
      },
      "billingAddress": {
        "firstName": "John",
        "lastName": "Doe"
      },
      "customerGroup": {
        "typeId": "customer-group",
        "id": "myCustomerGroup"
      },
      "country": "DE",
      "orderState": "Open",
      "shipmentState": "Pending",
      "paymentState": "Pending",
      "shippingInfo": {
        "shippingMethodName": "DHL"
      },
      "completedAt": "2015-05-01T15:20:00+00:00"
    }
    """
