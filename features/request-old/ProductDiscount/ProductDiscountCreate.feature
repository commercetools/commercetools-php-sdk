Feature: I want to create a new product discount
  Background:
    Given i have a productDiscount productDiscountValue object as discountValue
    And set the type to relative
    And set the permyriad to 1000 as int
    Given i have a productDiscount draft
    And the name is "myProductDiscount" in en
    And the value is discountValue object
    And the predicate is "test"
    And the sortOrder is "sort"
    And the isActive is 1 as bool
    And set the description to "My Product Discount" in en

  Scenario: create a product discount
    When i want to create a "productDiscount"
    Then the path should be "/product-discounts"
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
