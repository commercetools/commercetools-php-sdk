Feature: I want to create a new product type
  Background:
    Given i have a common enum object as enum
    And set the label to Foo
    And set the key to foo
    Given i have a productType attributeType object as type
    And set the name to enum
    And add the enum object to values collection
    Given i have a productType attributeDefinition object as attribute
    And set the name to "my-enum"
    And set the label to "My Enum" in en
    And set the isRequired to 0 as bool
    And set the attributeConstraint to None
    And set the isSearchable to 0 as bool
    And set the type object to type
    Given i have a zone locationCollection object as locations
    Given i have a productType draft
    And the name is "myProductType"
    And the description is "Product Type 1"
    And add the attribute object to attributes collection

  Scenario: create a product type
    When i want to create a "productType"
    Then the path should be "/product-types"
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
