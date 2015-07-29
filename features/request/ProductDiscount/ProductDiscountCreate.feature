Feature: I want to create a new product discount
  Background:
    Given i have a "productDiscount" draft with values
    """
    {
      "name": {
        "en": "myProductDiscount"
      },
      "description": {
        "en": "My Product Discount"
      },
      "value": {
        "type": "relative",
        "permyriad": 1000
      },
      "predicate": "test",
      "sortOrder": "sort",
      "isActive": true
    }
    """

  Scenario: create a product discount
    When i want to create a "productDiscount"
    Then the path should be "product-discounts"
    And the method should be "POST"
    And the request should be
    """
    {
      "name": {
        "en": "myProductDiscount"
      },
      "description": {
        "en": "My Product Discount"
      },
      "value": {
        "type": "relative",
        "permyriad": 1000
      },
      "predicate": "test",
      "sortOrder": "sort",
      "isActive": true
    }
    """
