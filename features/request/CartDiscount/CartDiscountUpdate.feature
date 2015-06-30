Feature: I want to update a cart discount
  Scenario: Empty update
    Given a "cartDiscount" is identified by "id" and version 1
    Given i want to update a "CartDiscount"
    Then the path should be "cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: Change cart discount value
    Given a "cartDiscount" is identified by "id" and version "1"
    And i want to update a "cartDiscount"
    And add the "changeValue" action to "cartDiscount" with values
    """
    {
      "action": "changeValue",
      "value": {
        "type": "absolute",
        "money": [{
          "currencyCode": "EUR",
          "centAmount": 1000
        }]
      }
    }
    """
    Then the path should be "/cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeValue",
          "value": {
            "type": "absolute",
            "money": [{
              "currencyCode": "EUR",
              "centAmount": 1000
            }]
          }
        }
      ]
    }
    """

  Scenario: Change cart discount predicate
    Given a "cartDiscount" is identified by "id" and version "1"
    And i want to update a "cartDiscount"
    And add the "changeCartPredicate" action to "cartDiscount" with values
    """
    {
      "action": "changeCartPredicate",
      "cartPredicate": "cart.value > 100"
    }
    """
    Then the path should be "/cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeCartPredicate",
          "cartPredicate": "cart.value > 100"
        }
      ]
    }
    """

  Scenario: Change cart discount target
    Given a "cartDiscount" is identified by "id" and version "1"
    And i want to update a "cartDiscount"
    And add the "changeTarget" action to "cartDiscount" with values
    """
    {
      "action": "changeTarget",
      "target": "LineItems"
    }
    """
    Then the path should be "/cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeTarget",
          "target": "LineItems"
        }
      ]
    }
    """

  Scenario: Change cart discount active state
    Given a "cartDiscount" is identified by "id" and version "1"
    And i want to update a "cartDiscount"
    And add the "changeIsActive" action to "cartDiscount" with values
    """
    {
      "action": "changeIsActive",
      "isActive": true
    }
    """
    Then the path should be "/cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeIsActive",
          "isActive": true
        }
      ]
    }
    """

  Scenario: Change cart discount name
    Given a "cartDiscount" is identified by "id" and version "1"
    And i want to update a "cartDiscount"
    And add the "changeName" action to "cartDiscount" with values
    """
    {
      "action": "changeName",
      "name": {
        "en": "New name"
      }
    }
    """
    Then the path should be "/cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeName",
          "name": {
            "en": "New name"
          }
        }
      ]
    }
    """

  Scenario: Set cart discount description
    Given a "cartDiscount" is identified by "id" and version "1"
    And i want to update a "cartDiscount"
    And add the "setDescription" action to "cartDiscount" with values
    """
    {
      "action": "setDescription",
      "description": {
        "en": "New description"
      }
    }
    """
    Then the path should be "/cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDescription",
          "description": {
            "en": "New description"
          }
        }
      ]
    }
    """

  Scenario: Set cart discount description
    Given a "cartDiscount" is identified by "id" and version "1"
    And i want to update a "cartDiscount"
    And add the "changeSortOrder" action to "cartDiscount" with values
    """
    {
      "action": "changeSortOrder",
      "sortOrder": "0.1"
    }
    """
    Then the path should be "/cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeSortOrder",
          "sortOrder": "0.1"
        }
      ]
    }
    """

  Scenario: Change Requires Discount Code
    Given a "cartDiscount" is identified by "id" and version "1"
    And i want to update a "cartDiscount"
    And add the "changeRequiresDiscountCode" action to "cartDiscount" with values
    """
    {
      "action": "changeRequiresDiscountCode",
      "requiresDiscountCode": true
    }
    """
    Then the path should be "/cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeRequiresDiscountCode",
          "requiresDiscountCode": true
        }
      ]
    }
    """

  Scenario: Set Valid From
    Given a "cartDiscount" is identified by "id" and version "1"
    And i want to update a "cartDiscount"
    And add the "setValidFrom" action to "cartDiscount" with values
    """
    {
      "action": "setValidFrom",
      "validFrom": "2015-01-15"
    }
    """
    Then the path should be "/cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setValidFrom",
          "validFrom": "2015-01-15T00:00:00+00:00"
        }
      ]
    }
    """

  Scenario: Set Valid Until
    Given a "cartDiscount" is identified by "id" and version "1"
    And i want to update a "cartDiscount"
    And add the "setValidUntil" action to "cartDiscount" with values
    """
    {
      "action": "setValidUntil",
      "validUntil": "2015-01-15"
    }
    """
    Then the path should be "/cart-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setValidUntil",
          "validUntil": "2015-01-15T00:00:00+00:00"
        }
      ]
    }
    """
