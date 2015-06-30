Feature: I want to create a new cart discount
  Background:
    Given i have a "cartDiscount" draft with values
    """
    {
      "name": {
        "en": "myCartDiscount"
      },
      "description": {
        "en": "CartDiscount 1"
      },
      "value": {
        "type": "absolute",
        "money": [
          {
            "currencyCode": "EUR",
            "centAmount": 100
          }
        ]
      },
      "cartPredicate": "test",
      "target": {
        "type": "lineItems",
        "predicate": "test"
      },
      "sortOrder": "0.2",
      "isActive": true,
      "validFrom": "2015-05-15T12:00:00+00:00",
      "validUntil": "2015-05-16T12:00:00+00:00",
      "requiresDiscountCode": false
    }
    """

  Scenario: create a cart discount
    When i want to create a "cartDiscount"
    Then the path should be "cart-discounts"
    And the method should be "POST"
    And the request should be
    """
    {
      "name": {
        "en": "myCartDiscount"
      },
      "description": {
        "en": "CartDiscount 1"
      },
      "value": {
        "type": "absolute",
        "money": [
          {
            "currencyCode": "EUR",
            "centAmount": 100
          }
        ]
      },
      "cartPredicate": "test",
      "target": {
        "type": "lineItems",
        "predicate": "test"
      },
      "sortOrder": "0.2",
      "isActive": true,
      "validFrom": "2015-05-15T12:00:00+00:00",
      "validUntil": "2015-05-16T12:00:00+00:00",
      "requiresDiscountCode": false
    }
    """
