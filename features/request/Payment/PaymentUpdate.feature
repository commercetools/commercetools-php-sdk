Feature: I want to update a product discount
  Scenario: Empty update
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: Set Customer
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setCustomer" action to "payment" with values
    """
    {
      "action": "setCustomer",
      "customer": {
        "typeId": "customer",
        "id": "customer-1"
      }
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setCustomer",
          "customer": {
            "typeId": "customer",
            "id": "customer-1"
          }
        }
      ]
    }
    """

  Scenario: Set External Id
  Given a "payment" is identified by "id" and version 1
  And i want to update a "payment"
  And add the "setExternalId" action to "payment" with values
    """
    {
      "action": "setExternalId",
      "externalId": "123456"
    }
    """
  Then the path should be "payments/id"
  And the method should be "POST"
  And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setExternalId",
          "externalId": "123456"
        }
      ]
    }
    """

  Scenario: Set Interface Id
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setInterfaceId" action to "payment" with values
    """
    {
      "action": "setInterfaceId",
      "interfaceId": "123456"
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setInterfaceId",
          "interfaceId": "123456"
        }
      ]
    }
    """

  Scenario: Set Authorization
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setAuthorization" action to "payment" with values
    """
    {
      "action": "setAuthorization",
      "amount": {
        "currencyCode": "EUR",
        "centAmount": 1000
      },
      "until": "2015-01-15T12:00"
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setAuthorization",
          "amount": {
            "currencyCode": "EUR",
            "centAmount": 1000
          },
          "until": "2015-01-15T12:00:00+00:00"
        }
      ]
    }
    """

  Scenario: Set amount paid
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setAmountPaid" action to "payment" with values
    """
    {
      "action": "setAmountPaid",
      "amount": {
        "currencyCode": "EUR",
        "centAmount": 1000
      }
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setAmountPaid",
          "amount": {
            "currencyCode": "EUR",
            "centAmount": 1000
          }
        }
      ]
    }
    """

  Scenario: Set amount refunded
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setAmountRefunded" action to "payment" with values
    """
    {
      "action": "setAmountRefunded",
      "amount": {
        "currencyCode": "EUR",
        "centAmount": 1000
      }
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setAmountRefunded",
          "amount": {
            "currencyCode": "EUR",
            "centAmount": 1000
          }
        }
      ]
    }
    """

  Scenario: Set method info interface
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setMethodInfoInterface" action to "payment" with values
    """
    {
      "action": "setMethodInfoInterface",
      "interface": "PSP"
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setMethodInfoInterface",
          "interface": "PSP"
        }
      ]
    }
    """


  Scenario: Set method info method
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setMethodInfoMethod" action to "payment" with values
    """
    {
      "action": "setMethodInfoMethod",
      "method": "CreditCard"
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setMethodInfoMethod",
          "method": "CreditCard"
        }
      ]
    }
    """

  Scenario: Set method info name
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setMethodInfoName" action to "payment" with values
    """
    {
      "action": "setMethodInfoName",
      "name": {
        "en": "Credit Card"
      }
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setMethodInfoName",
          "name": {
            "en": "Credit Card"
          }
        }
      ]
    }
    """

  Scenario: Set custom field
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setCustomField" action to "payment" with values
    """
    {
      "action": "setCustomField",
      "name": "key",
      "value": "1234"
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setCustomField",
          "name": "key",
          "value": "1234"
        }
      ]
    }
    """

  Scenario: Set custom type
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setCustomType" action to "payment" with values
    """
    {
      "action": "setCustomType",
      "typeKey": "payment-type",
      "fields": {
        "key": "value"
      }
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setCustomType",
          "typeKey": "payment-type",
          "fields": {
            "key": "value"
          }
        }
      ]
    }
    """

  Scenario: Set status interface code
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setStatusInterfaceCode" action to "payment" with values
    """
    {
      "action": "setStatusInterfaceCode",
      "interfaceCode": "authorized"
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setStatusInterfaceCode",
          "interfaceCode": "authorized"
        }
      ]
    }
    """

  Scenario: Set status interface text
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "setStatusInterfaceText" action to "payment" with values
    """
    {
      "action": "setStatusInterfaceText",
      "interfaceText": "Payment authorized"
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setStatusInterfaceText",
          "interfaceText": "Payment authorized"
        }
      ]
    }
    """

  Scenario: transition payment state
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "transitionState" action to "payment" with values
    """
    {
      "action": "transitionState",
      "state": {
        "typeId": "state",
        "id": "state-1234"
      }
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "transitionState",
          "state": {
            "typeId": "state",
            "id": "state-1234"
          }
        }
      ]
    }
    """

  Scenario: add transaction
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "addTransaction" action to "payment" with values
    """
    {
      "action": "addTransaction",
      "transaction": {
        "timestamp": "2015-01-15T12:00",
        "type": "AUTHORIZATION",
        "amount": {
          "currencyCode": "EUR",
          "centAmount": 1000
        },
        "interactionId": "123456"
      }
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addTransaction",
          "transaction": {
            "timestamp": "2015-01-15T12:00:00+00:00",
            "type": "AUTHORIZATION",
            "amount": {
              "currencyCode": "EUR",
              "centAmount": 1000
            },
            "interactionId": "123456"
          }
        }
      ]
    }
    """

  Scenario: Add interface interaction
    Given a "payment" is identified by "id" and version 1
    And i want to update a "payment"
    And add the "addInterfaceInteraction" action to "payment" with values
    """
    {
      "action": "addInterfaceInteraction",
      "typeKey": "payment-type",
      "fields": {
        "key": "value"
      }
    }
    """
    Then the path should be "payments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addInterfaceInteraction",
          "typeKey": "payment-type",
          "fields": {
            "key": "value"
          }
        }
      ]
    }
    """
