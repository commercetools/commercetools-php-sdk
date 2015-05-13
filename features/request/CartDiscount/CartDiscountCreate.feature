Feature: I want to create a new tax category
  Background:
    Given i have a common money object as discountMoney
    And the currencyCode is EUR
    And the centAmount is 100 as int
    Given i have a cartDiscount cartDiscountValue object as cartDiscountValue
    And set the type to absolute
    And add the discountMoney object to money collection
    Given i have a cartDiscount cartDiscountTarget object as cartDiscountTarget
    And set the type to lineItems
    And set the predicate to test
    Given i have a cartDiscount draft
    And the name is "myCartDiscount" in en
    And the value is cartDiscountValue object
    And the cartPredicate is "test"
    And the target is cartDiscountTarget object
    And the sortOrder is "0.2"
    And the isActive is 1 as bool
    And the requiresDiscountCode is 0 as bool
    And set the validFrom date to "2015-05-15 12:00"
    And set the validUntil date to "2015-05-16 12:00"
    And set the description to "CartDiscount 1" in en

  Scenario: create a category
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
