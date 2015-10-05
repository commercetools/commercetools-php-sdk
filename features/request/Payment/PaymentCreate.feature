Feature: I want to create a new product discount
  Background:
    Given i have a "payment" draft with values
    """
    {
      "customer": {
        "typeId": "customer",
        "id": "customer-1"
      },
      "externalId": "123456",
      "interfaceId": "PSP-Interface-Identifier",
      "amountPlanned": {
        "currencyCode": "EUR",
        "centAmount": 1000
      },
      "amountAuthorized": {
        "currencyCode": "EUR",
        "centAmount": 1000
      },
      "authorizedUntil": "2015-01-15T12:00",
      "amountPaid": {
        "currencyCode": "EUR",
        "centAmount": 1000
      },
      "amountRefunded": {
        "currencyCode": "EUR",
        "centAmount": 1000
      },
      "paymentMethodInfo": {
        "paymentInterface": "Interface name",
        "method": "CreditCard",
        "name": {
          "en": "Credit Card"
        }
      },
      "custom": {
        "typeKey": "paymentType",
        "fields": {
          "key": "value"
        }
      },
      "paymentStatus": {
        "interfaceCode": "authorized",
        "interfaceText": "Payment is authorized",
        "state": {
          "typeId": "state",
          "id": "state-1"
        },
        "transaction": [
          {
            "timestamp": "2015-01-15T12:00",
            "type": "AUTHORIZATION",
            "amount": {
              "currencyCode": "EUR",
              "centAmount": 1000
            },
            "interactionId": "123456"
          }
        ]
      },
      "interfaceInteraction": [
        {
          "typeId": "type-id-1234",
          "fields": {
            "key": "value"
          }
        }
      ]
    }
    """

  Scenario: create a product discount
    When i want to create a "payment"
    Then the path should be "payments"
    And the method should be "POST"
    And the request should be
    """
    {
      "customer": {
        "typeId": "customer",
        "id": "customer-1"
      },
      "externalId": "123456",
      "interfaceId": "PSP-Interface-Identifier",
      "amountPlanned": {
        "currencyCode": "EUR",
        "centAmount": 1000
      },
      "amountAuthorized": {
        "currencyCode": "EUR",
        "centAmount": 1000
      },
      "authorizedUntil": "2015-01-15T12:00:00+00:00",
      "amountPaid": {
        "currencyCode": "EUR",
        "centAmount": 1000
      },
      "amountRefunded": {
        "currencyCode": "EUR",
        "centAmount": 1000
      },
      "paymentMethodInfo": {
        "paymentInterface": "Interface name",
        "method": "CreditCard",
        "name": {
          "en": "Credit Card"
        }
      },
      "custom": {
        "typeKey": "paymentType",
        "fields": {
          "key": "value"
        }
      },
      "paymentStatus": {
        "interfaceCode": "authorized",
        "interfaceText": "Payment is authorized",
        "state": {
          "typeId": "state",
          "id": "state-1"
        },
        "transaction": [
          {
            "timestamp": "2015-01-15T12:00",
            "type": "AUTHORIZATION",
            "amount": {
              "currencyCode": "EUR",
              "centAmount": 1000
            },
            "interactionId": "123456"
          }
        ]
      },
      "interfaceInteraction": [
        {
          "typeId": "type-id-1234",
          "fields": {
            "key": "value"
          }
        }
      ]
    }
    """
