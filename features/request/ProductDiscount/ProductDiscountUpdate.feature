Feature: I want to update a product discount
  Scenario: Empty update
    Given a "productDiscount" is identified by "id" and version 1
    And i want to update a "productDiscount"
    Then the path should be "product-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: Change Value
    Given a "productDiscount" is identified by "id" and version 1
    And i want to update a "productDiscount"
    And add the "changeValue" action to "productDiscount" with values
    """
    {
      "action": "changeValue",
      "value": {
        "type": "absolute",
        "money": [{
          "currencyCode": "EUR",
          "centAmount": 100
        }]
      }
    }
    """
    Then the path should be "product-discounts/id"
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
              "centAmount": 100
            }]
          }
        }
      ]
    }
    """

  Scenario: Change Predicate
    Given a "productDiscount" is identified by "id" and version 1
    And i want to update a "productDiscount"
    And add the "changePredicate" action to "productDiscount" with values
    """
    {
      "action": "changePredicate",
      "predicate": "predicateString"
    }
    """
    Then the path should be "product-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changePredicate",
          "predicate": "predicateString"
        }
      ]
    }
    """

  Scenario: Change IsActive
    Given a "productDiscount" is identified by "id" and version 1
    And i want to update a "productDiscount"
    And add the "changeIsActive" action to "productDiscount" with values
    """
    {
      "action": "changeIsActive",
      "isActive": true
    }
    """
    Then the path should be "product-discounts/id"
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
    Given a "productDiscount" is identified by "id" and version "1"
    And i want to update a "productDiscount"
    And add the "changeName" action to "productDiscount" with values
    """
    {
      "action": "changeName",
      "name": {
        "en": "New name"
      }
    }
    """
    Then the path should be "product-discounts/id"
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
    Given a "productDiscount" is identified by "id" and version "1"
    And i want to update a "productDiscount"
    And add the "setDescription" action to "productDiscount" with values
    """
    {
      "action": "setDescription",
      "description": {
        "en": "New description"
      }
    }
    """
    Then the path should be "product-discounts/id"
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

  Scenario: change sort order
    Given a "productDiscount" is identified by "id" and version "1"
    And i want to update a "productDiscount"
    And add the "changeSortOrder" action to "productDiscount" with values
    """
    {
      "action": "changeSortOrder",
      "sortOrder": "0.1"
    }
    """
    Then the path should be "product-discounts/id"
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
