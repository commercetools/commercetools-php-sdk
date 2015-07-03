Feature: I want to update a tax category
  Scenario: Empty update
    Given a "taxCategory" is identified by "id" and version 1
    And i want to update a "taxCategory"
    Then the path should be "tax-categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: Change name of tax category
    Given a "taxCategory" is identified by "id" and version 1
    And i want to update a "taxCategory"
    And add the "changeName" action to "taxCategory" with values
    """
    {
      "action": "changeName",
      "name": "New tax category name"
    }
    """
    Then the path should be "tax-categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeName",
          "name": "New tax category name"
        }
      ]
    }
    """

  Scenario: Set description
    Given a "taxCategory" is identified by "id" and version 1
    And i want to update a "taxCategory"
    And add the "setDescription" action to "taxCategory" with values
    """
    {
      "action": "setDescription",
      "description": "New description"
    }
    """
    Then the path should be "tax-categories/id"
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

  Scenario: Add tax rate
    Given a "taxCategory" is identified by "id" and version 1
    And i want to update a "taxCategory"
    And add the "addTaxRate" action to "taxCategory" with values
    """
    {
      "action": "addTaxRate",
      "taxRate": {
        "name": "Mwst 19%",
        "amount": 0.19,
        "includedInPrice": false,
        "country": "DE",
        "state": "Berlin"
      }
    }
    """
    Then the path should be "tax-categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addTaxRate",
          "taxRate": {
            "name": "Mwst 19%",
            "amount": 0.19,
            "includedInPrice": false,
            "country": "DE",
            "state": "Berlin"
          }
        }
      ]
    }
    """

  Scenario: Replace tax rate
    Given a "taxCategory" is identified by "id" and version 1
    And i want to update a "taxCategory"
    And add the "replaceTaxRate" action to "taxCategory" with values
    """
    {
      "action": "replaceTaxRate",
      "taxRateId": "<tax-rate-id>",
      "taxRate": {
        "name": "Mwst 19%",
        "amount": 0.19,
        "includedInPrice": false,
        "country": "DE",
        "state": "Berlin"
      }
    }
    """
    Then the path should be "tax-categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "replaceTaxRate",
          "taxRateId": "<tax-rate-id>",
          "taxRate": {
            "name": "Mwst 19%",
            "amount": 0.19,
            "includedInPrice": false,
            "country": "DE",
            "state": "Berlin"
          }
        }
      ]
    }
    """

  Scenario: Remove tax rate
    Given a "taxCategory" is identified by "id" and version 1
    And i want to update a "taxCategory"
    And add the "removeTaxRate" action to "taxCategory" with values
    """
    {
      "action": "removeTaxRate",
      "rateId": "<tax-rate-id>"
    }
    """
    Then the path should be "tax-categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "replaceTaxRate",
          "rateId": "<tax-rate-id>"
        }
      ]
    }
    """
