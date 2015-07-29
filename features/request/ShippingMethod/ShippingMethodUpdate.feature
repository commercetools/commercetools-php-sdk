Feature: I want to update a shippingMethod
  Scenario: Empty update
    Given a "shippingMethod" is identified by "id" and version 1
    And i want to update a "shippingMethod"
    Then the path should be "shipping-methods/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: change name
    Given a "shippingMethod" is identified by "id" and version 1
    And i want to update a "shippingMethod"
    And add the "changeName" action to "shippingMethod" with values
    """
    {
      "action": "changeName",
      "name": "New name"
    }
    """
    Then the path should be "shipping-methods/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeName",
          "name": "New name"
        }
      ]
    }
    """

  Scenario: set description
    Given a "shippingMethod" is identified by "id" and version 1
    And i want to update a "shippingMethod"
    And add the "setDescription" action to "shippingMethod" with values
    """
    {
      "action": "setDescription",
      "description": "New description"
    }
    """
    Then the path should be "shipping-methods/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDescription",
          "description": "New description"
        }
      ]
    }
    """

  Scenario: change tax category
    Given a "shippingMethod" is identified by "id" and version 1
    And i want to update a "shippingMethod"
    And add the "changeTaxCategory" action to "shippingMethod" with values
    """
    {
      "action": "changeTaxCategory",
      "taxCategory": {
        "typeId": "tax-category",
        "id": "<tax-category-id>"
      }
    }
    """
    Then the path should be "shipping-methods/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeTaxCategory",
          "taxCategory": {
            "typeId": "tax-category",
            "id": "<tax-category-id>"
          }
        }
      ]
    }
    """

  Scenario: change is default
    Given a "shippingMethod" is identified by "id" and version 1
    And i want to update a "shippingMethod"
    And add the "changeIsDefault" action to "shippingMethod" with values
    """
    {
      "action": "changeIsDefault",
      "isDefault": true
    }
    """
    Then the path should be "shipping-methods/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeIsDefault",
          "isDefault": true
        }
      ]
    }
    """

  Scenario: add shipping rate
    Given a "shippingMethod" is identified by "id" and version 1
    And i want to update a "shippingMethod"
    And add the "addShippingRate" action to "shippingMethod" with values
    """
    {
      "action": "addShippingRate",
      "zone": {
        "typeId": "zone",
        "id": "<zone-id>"
      },
      "shippingRate": {
        "price": {
          "currencyCode": "EUR",
          "centAmount": 100
        },
        "freeAbove": {
          "currencyCode": "EUR",
          "centAmount": 100
        }
      }
    }
    """
    Then the path should be "shipping-methods/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addShippingRate",
          "zone": {
            "typeId": "zone",
            "id": "<zone-id>"
          },
          "shippingRate": {
            "price": {
              "currencyCode": "EUR",
              "centAmount": 100
            },
            "freeAbove": {
              "currencyCode": "EUR",
              "centAmount": 100
            }
          }
        }
      ]
    }
    """

  Scenario: remove shipping rate
    Given a "shippingMethod" is identified by "id" and version 1
    And i want to update a "shippingMethod"
    And add the "removeShippingRate" action to "shippingMethod" with values
    """
    {
      "action": "removeShippingRate",
      "zone": {
        "typeId": "zone",
        "id": "<zone-id>"
      },
      "shippingRate": {
        "price": {
          "currencyCode": "EUR",
          "centAmount": 100
        },
        "freeAbove": {
          "currencyCode": "EUR",
          "centAmount": 100
        }
      }
    }
    """
    Then the path should be "shipping-methods/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeShippingRate",
          "zone": {
            "typeId": "zone",
            "id": "<zone-id>"
          },
          "shippingRate": {
            "price": {
              "currencyCode": "EUR",
              "centAmount": 100
            },
            "freeAbove": {
              "currencyCode": "EUR",
              "centAmount": 100
            }
          }
        }
      ]
    }
    """

  Scenario: add zone
    Given a "shippingMethod" is identified by "id" and version 1
    And i want to update a "shippingMethod"
    And add the "addZone" action to "shippingMethod" with values
    """
    {
      "action": "addZone",
      "zone": {
        "typeId": "zone",
        "id": "<zone-id>"
      }
    }
    """
    Then the path should be "shipping-methods/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addZone",
          "zone": {
            "typeId": "zone",
            "id": "<zone-id>"
          }
        }
      ]
    }
    """

  Scenario: remove zone
    Given a "shippingMethod" is identified by "id" and version 1
    And i want to update a "shippingMethod"
    And add the "removeZone" action to "shippingMethod" with values
    """
    {
      "action": "removeZone",
      "zone": {
        "typeId": "zone",
        "id": "<zone-id>"
      }
    }
    """
    Then the path should be "shipping-methods/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeZone",
          "zone": {
            "typeId": "zone",
            "id": "<zone-id>"
          }
        }
      ]
    }
    """
