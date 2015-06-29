Feature: I want to send a Customer Update Request
  Scenario: Change order state
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "changeOrderState" action to "order" with values
    """
        {
          "action": "changeOrderState",
          "orderState": "Complete"
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeOrderState",
          "orderState": "Complete"
        }
      ]
    }
    """

  Scenario: Change shipment state
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "changeShipmentState" action to "order" with values
    """
        {
          "action": "changeShipmentState",
          "shipmentState": "Pending"
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeShipmentState",
          "shipmentState": "Pending"
        }
      ]
    }
    """

  Scenario: Change payment state
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "changePaymentState" action to "order" with values
    """
        {
          "action": "changePaymentState",
          "paymentState": "Paid"
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changePaymentState",
          "paymentState": "Paid"
        }
      ]
    }
    """

  Scenario: Update Sync Info
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "updateSyncInfo" action to "order" with values
    """
        {
          "action": "updateSyncInfo",
          "channel": {
            "typeId": "channel",
            "id": "myChannel"
          },
          "externalId": "ext-id",
          "syncedAt": "2015-03-15T15:56:00+00:00"
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "updateSyncInfo",
          "channel": {
            "typeId": "channel",
            "id": "myChannel"
          },
          "externalId": "ext-id",
          "syncedAt": "2015-03-15T15:56:00+00:00"
        }
      ]
    }
    """

  Scenario: Add return info
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "addReturnInfo" action to "order" with values
    """
        {
          "action": "addReturnInfo",
          "returnDate": "2015-03-15T15:56:00+00:00",
          "returnTrackingId": "1234567890",
          "items": [
            {
              "quantity": 1,
              "lineItemId": "123456",
              "comment": "Hello world",
              "shipmentState": "Returned"
            }
          ]
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addReturnInfo",
          "returnDate": "2015-03-15T15:56:00+00:00",
          "returnTrackingId": "1234567890",
          "items": [
            {
              "quantity": 1,
              "lineItemId": "123456",
              "comment": "Hello world",
              "shipmentState": "Returned"
            }
          ]
        }
      ]
    }
    """

  Scenario: Set ReturnShipmentState
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "setReturnShipmentState" action to "order" with values
    """
        {
          "action": "setReturnShipmentState",
          "returnItemId": "1234567890",
          "shipmentState": "Returned"
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setReturnShipmentState",
          "returnItemId": "1234567890",
          "shipmentState": "Returned"
        }
      ]
    }
    """

  Scenario: Set ReturnPaymentState
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "setReturnPaymentState" action to "order" with values
    """
        {
          "action": "setReturnPaymentState",
          "returnItemId": "1234567890",
          "paymentState": "Refunded"
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setReturnPaymentState",
          "returnItemId": "1234567890",
          "paymentState": "Refunded"
        }
      ]
    }
    """

  Scenario: Transition LineItemState
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "transitionLineItemState" action to "order" with values
    """
        {
          "action": "transitionLineItemState",
          "lineItemId": "1234567890",
          "quantity": 1,
          "fromState": {
            "typeId": "state",
            "id": "initial"
          },
          "toState": {
            "typeId": "state",
            "id": "new"
          },
          "actualTransitionDate": "2015-03-24T12:13:00+00:00"
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "transitionLineItemState",
          "lineItemId": "1234567890",
          "quantity": 1,
          "fromState": {
            "typeId": "state",
            "id": "initial"
          },
          "toState": {
            "typeId": "state",
            "id": "new"
          },
          "actualTransitionDate": "2015-03-24T12:13:00+00:00"
        }
      ]
    }
    """

  Scenario: Transition CustomLineItemState
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "transitionCustomLineItemState" action to "order" with values
    """
        {
          "action": "transitionCustomLineItemState",
          "customLineItemId": "1234567890",
          "quantity": 1,
          "fromState": {
            "typeId": "state",
            "id": "initial"
          },
          "toState": {
            "typeId": "state",
            "id": "new"
          },
          "actualTransitionDate": "2015-03-24T12:13:00+00:00"
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "transitionCustomLineItemState",
          "customLineItemId": "1234567890",
          "quantity": 1,
          "fromState": {
            "typeId": "state",
            "id": "initial"
          },
          "toState": {
            "typeId": "state",
            "id": "new"
          },
          "actualTransitionDate": "2015-03-24T12:13:00+00:00"
        }
      ]
    }
    """

  Scenario: Import a state for LineItems
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "importLineItemState" action to "order" with values
    """
        {
          "action": "importLineItemState",
          "lineItemId": "1234567890",
          "state": [
            {
              "quantity": 1,
              "state": {
                "typeId": "state",
                "id": "initial"
              }
            }
          ]
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "importLineItemState",
          "lineItemId": "1234567890",
          "state": [
            {
              "quantity": 1,
              "state": {
                "typeId": "state",
                "id": "initial"
              }
            }
          ]
        }
      ]
    }
    """

  Scenario: Import a state for CustomLineItems
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "importCustomLineItemState" action to "order" with values
    """
        {
          "action": "importCustomLineItemState",
          "customLineItemId": "1234567890",
          "state": [
            {
              "quantity": 1,
              "state": {
                "typeId": "state",
                "id": "initial"
              }
            }
          ]
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "importCustomLineItemState",
          "customLineItemId": "1234567890",
          "state": [
            {
              "quantity": 1,
              "state": {
                "typeId": "state",
                "id": "initial"
              }
            }
          ]
        }
      ]
    }
    """

  Scenario: Add a parcel
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "addParcelToDelivery" action to "order" with values
    """
        {
          "action": "addParcelToDelivery",
          "deliveryId": "1234567890",
          "measurements": {
            "heightInMillimeter": 100,
            "lengthInMillimeter": 200,
            "widthInMillimeter": 300,
            "weightInGram": 400
          },
          "trackingData": {
            "trackingId": "1234567890",
            "carrier": "Post",
            "provider": "Shop",
            "providerTransaction": "abcdef",
            "isReturn": false
          }
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addParcelToDelivery",
          "deliveryId": "1234567890",
          "measurements": {
            "heightInMillimeter": 100,
            "lengthInMillimeter": 200,
            "widthInMillimeter": 300,
            "weightInGram": 400
          },
          "trackingData": {
            "trackingId": "1234567890",
            "carrier": "Post",
            "provider": "Shop",
            "providerTransaction": "abcdef",
            "isReturn": false
          }
        }
      ]
    }
    """

  Scenario: Set order number
    Given a "order" is identified by "id" and version "1"
    And i want to update a "order"
    And add the "setOrderNumber" action to "order" with values
    """
        {
          "action": "setOrderNumber",
          "orderNumber": "1234567890"
        }
    """
    Then the path should be "/orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setOrderNumber",
          "orderNumber": "1234567890"
        }
      ]
    }
    """
