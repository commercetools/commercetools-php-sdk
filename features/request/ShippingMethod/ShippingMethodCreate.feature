Feature: I want to create a new zone
  Background:
    Given i have a "shippingMethod" draft with values
    """
    {
      "name": "myShippingMethod",
      "description": "Shipping Method 1",
      "taxCategory": {
        "typeId": "tax-category",
        "id": "tax-category-id"
      },
      "zoneRates": [
        {
          "zone": {
            "typeId": "zone",
            "id": "zone-id"
          },
          "shippingRates": [
            {
              "price": {
                "currencyCode": "EUR",
                "centAmount": 100
              },
              "freeAbove": {
                "currencyCode": "EUR",
                "centAmount": 200
              }
            }
          ]
        }
      ],
      "isDefault": true
    }
    """

  Scenario: create a zone
    When i want to create a "shippingMethod"
    Then the path should be "/shipping-methods"
    And the method should be "POST"
    And the request should be
    """
    {
      "name": "myShippingMethod",
      "description": "Shipping Method 1",
      "taxCategory": {
        "typeId": "tax-category",
        "id": "tax-category-id"
      },
      "zoneRates": [
        {
          "zone": {
            "typeId": "zone",
            "id": "zone-id"
          },
          "shippingRates": [
            {
              "price": {
                "currencyCode": "EUR",
                "centAmount": 100
              },
              "freeAbove": {
                "currencyCode": "EUR",
                "centAmount": 200
              }
            }
          ]
        }
      ],
      "isDefault": true
    }
    """
