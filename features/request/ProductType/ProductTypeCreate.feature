Feature: I want to create a new product type
  Background:
    Given i have a "productType" draft with values
    """
    {
      "name": "myProductType",
      "description": "Product Type 1",
      "attributes": [
        {
          "type": {
            "name": "enum",
            "values": [
              {
                "key": "foo",
                "label": "Foo"
              }
            ]
          },
          "name": "my-enum",
          "label": {
            "en": "My Enum"
          },
          "isRequired": false,
          "attributeConstraint": "None",
          "isSearchable": false
        }
      ]
    }
    """

  Scenario: create a product type
    When i want to create a "productType"
    Then the path should be "product-types"
    And the method should be "POST"
    And the request should be
    """
    {
      "name": "myProductType",
      "description": "Product Type 1",
      "attributes": [
        {
          "type": {
            "name": "enum",
            "values": [
              {
                "key": "foo",
                "label": "Foo"
              }
            ]
          },
          "name": "my-enum",
          "label": {
            "en": "My Enum"
          },
          "isRequired": false,
          "attributeConstraint": "None",
          "isSearchable": false
        }
      ]
    }
    """
