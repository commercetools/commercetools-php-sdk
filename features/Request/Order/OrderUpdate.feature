Feature: I want to send a Customer Update Request
  Background:
    Given a "order" is identified by "id" and "version"

  Scenario: Change order state
    Given i want to "changeOrderState" of "order"
    And the orderState is "Complete"
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeOrderState",
          "orderState": "Complete"
        }
      ]
    }
    """

  Scenario: Change shipment state
    Given i want to "changeShipmentState" of "order"
    And the shipmentState is "Pending"
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeShipmentState",
          "shipmentState": "Pending"
        }
      ]
    }
    """

  Scenario: Change payment state
    Given i want to "changePaymentState" of "order"
    And the paymentState is "Paid"
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changePaymentState",
          "paymentState": "Paid"
        }
      ]
    }
    """

  Scenario: Update Sync Info
    Given i want to "updateSyncInfo" of "order"
    And the channel reference channel is "myChannel"
    And set the externalId to "ext-id"
    And set the syncedAt date to "2015-03-15T17:56+02:00"
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i have a "order" "returnItem" object as "returnItem"
    And set the quantity to 1 as int
    And set the lineItemId to "123456"
    And set the comment to "Hello world"
    And set the shipmentState to "Returned"
    Given i have a "order" "returnItemCollection" object as "returnItems"
    And add the "returnItem" object to "returnItems" collection
    Given i want to "addReturnInfo" of "order"
    And set the returnDate date to "2015-03-15 15:56"
    And set the returnTrackingId to "1234567890"
    And set the returnItems object to items
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "setReturnShipmentState" of "order"
    And the returnItemId is "1234567890"
    And the shipmentState is "Returned"
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "setReturnPaymentState" of "order"
    And the returnItemId is "1234567890"
    And the paymentState is "Refunded"
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "transitionLineItemState" of "order"
    And the lineItemId is "1234567890"
    And the quantity is "1" as int
    And the state reference fromState is "initial"
    And the state reference toState is "new"
    And set the actualTransitionDate date to "2015-03-24 12:13"
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "transitionCustomLineItemState" of "order"
    And the customLineItemId is "1234567890"
    And the quantity is "1" as int
    And the state reference fromState is "initial"
    And the state reference toState is "new"
    And set the actualTransitionDate date to "2015-03-24 12:13"
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i have a "order" "itemState" object as "itemState"
    And set the "quantity" to "1" as int
    And set the "state" reference "state" to "initial"
    Given i have a "order" "itemStateCollection" object as "itemStates"
    And add the "itemState" object to "itemStates" collection
    Given i want to "importLineItemState" of "order"
    And the lineItemId is "1234567890"
    And the state is itemStates object
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i have a "order" "itemState" object as "itemState"
    And set the "quantity" to "1" as int
    And set the "state" reference "state" to "initial"
    Given i have a "order" "itemStateCollection" object as "itemStates"
    And add the "itemState" object to "itemStates" collection
    Given i want to "importCustomLineItemState" of "order"
    And the customLineItemId is "1234567890"
    And the state is itemStates object
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i have a order parcelMeasurements object as myMeasurement
    And set the heightInMillimeter to 100 as int
    And set the lengthInMillimeter to 200 as int
    And set the widthInMillimeter to 300 as int
    And set the weightInGram to 400 as int
    Given i have a order trackingData object as myTrackingData
    And set the trackingId to "1234567890"
    And set the carrier to "Post"
    And set the provider to "Shop"
    And set the providerTransaction to "abcdef"
    And set the isReturn to 0 as bool
    Given i want to "addParcelToDelivery" of "order"
    And the deliveryId is "1234567890"
    And set the myMeasurement object to measurements
    And set the myTrackingData object to trackingData
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "setOrderNumber" of "order"
    And set the orderNumber to "1234567890"
    When i want to update a "order"
    Then the path should be "orders/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setOrderNumber",
          "orderNumber": "1234567890"
        }
      ]
    }
    """
