Feature: I want to update a discount code
  Scenario: Empty update
    Given a "discountCode" is identified by "id" and version 1
    Given i want to update a "discountCode"
    Then the path should be "discount-codes/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: Set name
    Given a "discountCode" is identified by "id" and version 1
    Given i want to update a "discountCode"
    And add the "setName" action to "discountCode" with values
    """
    {
      "action": "setName",
      "name": {
        "en": "NL registration"
      }
    }
    """
    Then the path should be "discount-codes/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setName",
          "name": {
            "en": "NL registration"
          }
        }
      ]
    }
    """

  Scenario: Set description
    Given a "discountCode" is identified by "id" and version 1
    Given i want to update a "discountCode"
    And add the "setDescription" action to "discountCode" with values
    """
    {
      "action": "setDescription",
      "description": {
        "en": "NL registration"
      }
    }
    """
    Then the path should be "discount-codes/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDescription",
          "description": {
            "en": "NL registration"
          }
        }
      ]
    }
    """

   Scenario: Set cart predicate
    Given a "discountCode" is identified by "id" and version 1
    Given i want to update a "discountCode"
    And add the "setCartPredicate" action to "discountCode" with values
    """
    {
      "action": "setCartPredicate",
      "cartPredicate": "totalPrice > \"800.00 EUR\""
    }
    """
    Then the path should be "discount-codes/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setCartPredicate",
          "cartPredicate": "totalPrice > \"800.00 EUR\""
        }
      ]
    }
    """

  Scenario: Set max applications
    Given a "discountCode" is identified by "id" and version 1
    Given i want to update a "discountCode"
    And add the "setMaxApplications" action to "discountCode" with values
    """
    {
      "action": "setMaxApplications",
      "maxApplications": 10
    }
    """
    Then the path should be "discount-codes/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setMaxApplications",
          "maxApplications": 10
        }
      ]
    }
    """

  Scenario: Set max applications per customer
    Given a "discountCode" is identified by "id" and version 1
    Given i want to update a "discountCode"
    And add the "setMaxApplicationsPerCustomer" action to "discountCode" with values
    """
    {
      "action": "setMaxApplicationsPerCustomer",
      "maxApplicationsPerCustomer": 1
    }
    """
    Then the path should be "discount-codes/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setMaxApplicationsPerCustomer",
          "maxApplicationsPerCustomer": 1
        }
      ]
    }
    """

  Scenario: change cart discounts
    Given a "discountCode" is identified by "id" and version 1
    Given i want to update a "discountCode"
    And add the "changeCartDiscounts" action to "discountCode" with values
    """
    {
      "action": "changeCartDiscounts",
      "cartDiscounts": [
        {
          "typeId": "cart-discount",
          "id": "<cart-discount-id>"
        }
      ]
    }
    """
    Then the path should be "discount-codes/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeCartDiscounts",
          "cartDiscounts": [
            {
              "typeId": "cart-discount",
              "id": "<cart-discount-id>"
            }
          ]
        }
      ]
    }
    """

  Scenario: change isActive
    Given a "discountCode" is identified by "id" and version 1
    Given i want to update a "discountCode"
    And add the "changeIsActive" action to "discountCode" with values
    """
    {
      "action": "changeIsActive",
      "isActive": true
    }
    """
    Then the path should be "discount-codes/id"
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
