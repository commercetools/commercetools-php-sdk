Feature: I want to create a new discount code
  Background:
    Given i have a cartDiscount cartDiscountReference object as cartDiscountReference
    And the id is cartDiscountId
    Given i have a cartDiscount cartDiscountReferenceCollection object as discountReferences
    And add the cartDiscountReference object to discountReferences collection
    Given i have a discountCode draft
    And the code is "discount"
    And the cartDiscounts is discountReferences object
    And the isActive is 1 as bool
    And set the name to "myDiscountCode" in en
    And set the description to "My DiscountCode" in en
    And set the cartPredicate to test
    And set the maxApplications to 100 as int
    And set the maxApplicationsPerCustomer to 1 as int

  Scenario: create a discount code
    When i want to create a "discountCode"
    Then the path should be "/discount-codes"
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
