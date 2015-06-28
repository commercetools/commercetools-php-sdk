Feature: I want to import a new order
  Scenario: import an order from values
    Given i want to import a "order" with values
    """
    {
      "orderNumber": "12345",
      "customerId": "abc",
      "customerEmail": "john.doe@example.org",
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
    Then the path should be "/orders/import"
    And the method should be "POST"
    And the request should be
    """
    {
      "orderNumber": "12345",
      "customerId": "abc",
      "customerEmail": "john.doe@example.org",
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
