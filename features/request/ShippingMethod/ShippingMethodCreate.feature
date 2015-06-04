Feature: I want to create a new zone
  Background:
    Given i have a common money object as shippingPrice
    And the currencyCode is EUR
    And the centAmount is 100 as int
    Given i have a common money object as freeAbovePrice
    And the currencyCode is EUR
    And the centAmount is 200 as int
    Given i have a shippingMethod shippingRate object as shippingRate
    And set the shippingPrice object to price
    And set the freeAbovePrice object to freeAbove
    Given i have a shippingMethod zoneRate object as zoneRate
    And set the zone reference zone to "zone-id"
    And add the shippingRate object to shippingRates collection
    Given i have a shippingMethod zoneRateCollection object as zoneRates
    And add the zoneRate object to zoneRates collection
    Given i have a shippingMethod draft
    And the name is "myShippingMethod"
    And the taxCategory reference taxCategory is "tax-category-id"
    And the zoneRates is zoneRates object
    And the isDefault is 1 as bool
    And set the description to "Shipping Method 1"

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
