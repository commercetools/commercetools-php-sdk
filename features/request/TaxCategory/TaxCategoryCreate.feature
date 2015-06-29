Feature: I want to create a new tax category
  Background:
    Given i have a "taxCategory" draft with values
    """
    {
      "name": "myTaxCategory",
      "description": "TaxCategory 1",
      "rates": [
        {
          "name": "Mwst",
          "amount": 0.19,
          "includedInPrice": true,
          "country": "DE",
          "state": "Berlin"
        }
      ]
    }
    """

  Scenario: create a tax category
    When i want to create a "taxCategory"
    Then the path should be "/tax-categories"
    And the method should be "POST"
    And the request should be
    """
    {
      "name": "myTaxCategory",
      "description": "TaxCategory 1",
      "rates": [
        {
          "name": "Mwst",
          "amount": 0.19,
          "includedInPrice": true,
          "country": "DE",
          "state": "Berlin"
        }
      ]
    }
    """
