Feature: I want to create a new discount code
  Background:
    Given i have a "discountCode" draft with values
    """
    {
      "name": {
        "en": "myDiscountCode"
      },
      "description": {
        "en": "My DiscountCode"
      },
      "code": "discount",
      "cartDiscounts": [
        {
          "typeId": "cart-discount",
          "id": "cartDiscountId"
        }
      ],
      "cartPredicate": "test",
      "isActive": true,
      "maxApplications": 100,
      "maxApplicationsPerCustomer": 1
    }
    """

  Scenario: create a discount code
    When i want to create a "discountCode"
    Then the path should be "discount-codes"
    And the method should be "POST"
    And the request should be
    """
    {
      "name": {
        "en": "myDiscountCode"
      },
      "description": {
        "en": "My DiscountCode"
      },
      "code": "discount",
      "cartDiscounts": [
        {
          "typeId": "cart-discount",
          "id": "cartDiscountId"
        }
      ],
      "cartPredicate": "test",
      "isActive": true,
      "maxApplications": 100,
      "maxApplicationsPerCustomer": 1
    }
    """
