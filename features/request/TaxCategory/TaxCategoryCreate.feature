Feature: I want to create a new tax category
  Background:
    Given i have a taxCategory taxRate object as taxRate
    And set the name to Mwst
    And set the amount to 0.19 as float
    And set the includedInPrice to 1 as bool
    And set the country to DE
    And set the state to Berlin
    Given i have a taxCategory TaxRateCollection object as taxRates
    And add the taxRate object to taxRates collection
    Given i have a taxCategory draft
    And the name is "myTaxCategory"
    And the rates is taxRates object
    And set the description to "TaxCategory 1"

  Scenario: create a tax category
    When i want to create a "taxCategory"
    Then the path should be "tax-categories"
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
