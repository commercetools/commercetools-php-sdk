Feature: I want to update a product discount
  Background:
    Given a "productDiscount" is identified by "id" and "version"
  Scenario: Empty update
    Given i want to update a "productDiscount"
    Then the path should be "/product-discounts/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
      ]
    }
    """
