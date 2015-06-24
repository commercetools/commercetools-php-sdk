Feature: I want to update a product type
  Background:
    Given a "productType" is identified by "id" and version 1
  Scenario: Empty update
    Given i want to update a "productType"
    Then the path should be "/product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """
