Feature: I want to update a product type
  Scenario: Empty update
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: change name
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    And add the "changeName" action to "productType" with values
    """
    {
      "action": "changeName",
      "name": "New product type name"
    }
    """
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeName",
          "name": "New product type name"
        }
      ]
    }
    """

  Scenario: change description
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    And add the "changeDescription" action to "productType" with values
    """
    {
      "action": "changeDescription",
      "description": "New product type description"
    }
    """
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeDescription",
          "description": "New product type description"
        }
      ]
    }
    """

  Scenario: add attribute definition
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    And add the "addAttributeDefinition" action to "productType" with values
    """
    {
      "action": "addAttributeDefinition",
      "attribute": {
        "type": {
          "name": "lenum",
          "values": [
            {
              "key": "enum_key1",
              "label": {
                "en": "Enum Key 1"
              }
            }
          ]
        },
        "name": "localized_enum",
        "label": {
          "en": "Localized Enum"
        },
        "isRequired": true,
        "attributeConstraint": "",
        "isSearchable": false
      }
    }
    """
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addAttributeDefinition",
          "attribute": {
            "type": {
              "name": "lenum",
              "values": [
                {
                  "key": "enum_key1",
                  "label": {
                    "en": "Enum Key 1"
                  }
                }
              ]
            },
            "name": "localized_enum",
            "label": {
              "en": "Localized Enum"
            },
            "isRequired": true,
            "attributeConstraint": "",
            "isSearchable": false
          }
        }
      ]
    }
    """

  Scenario: remove attribute definition
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    And add the "removeAttributeDefinition" action to "productType" with values
    """
    {
      "action": "removeAttributeDefinition",
      "name": "localized_enum"
    }
    """
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeAttributeDefinition",
          "name": "localized_enum"
        }
      ]
    }
    """

  Scenario: change attribute definition label
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    And add the "changeLabel" action to "productType" with values
    """
    {
      "action": "changeLabel",
      "attributeName": "localized_enum",
      "label": {
        "en": "New label"
      }
    }
    """
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeLabel",
          "attributeName": "localized_enum",
          "label": {
            "en": "New label"
          }
        }
      ]
    }
    """

  Scenario: add a plain enum value to an attribute definition
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    And add the "addPlainEnumValue" action to "productType" with values
    """
    {
      "action": "addPlainEnumValue",
      "attributeName": "plain_enum",
      "value": {
        "key": "enum_key1",
        "label": "Enum Key 1"
      }
    }
    """
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addPlainEnumValue",
          "attributeName": "plain_enum",
          "value": {
            "key": "enum_key1",
            "label": "Enum Key 1"
          }
        }
      ]
    }
    """

  Scenario: add a localizable enum value to an attribute definition
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    And add the "addLocalizedEnumValue" action to "productType" with values
    """
    {
      "action": "addLocalizedEnumValue",
      "attributeName": "localized_enum",
      "value": {
        "key": "enum_key1",
        "label": {
          "en": "Enum Key 1"
        }
      }
    }
    """
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addLocalizedEnumValue",
          "attributeName": "localized_enum",
          "value": {
            "key": "enum_key1",
            "label": {
              "en": "Enum Key 1"
            }
          }
        }
      ]
    }
    """

  Scenario: change the order of attribute definitions
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    And add the "changeAttributeOrder" action to "productType" with values
    """
    {
      "action": "changeAttributeOrder",
      "attributes": [
        {
          "type": {
            "name": "lenum",
            "values": [
              {
                "key": "enum_key1",
                "label": {
                  "en": "Enum Key 1"
                }
              }
            ]
          },
          "name": "localized_enum",
          "label": {
            "en": "Localized Enum"
          },
          "isRequired": true,
          "attributeConstraint": "None",
          "isSearchable": false
        },
        {
          "type": {
            "name": "enum",
            "values": [
              {
                "key": "enum_key1",
                "label": "Enum Key 1"
                }
              }
            ]
          },
          "name": "enum",
          "label": {
            "en": "Enum"
          },
          "isRequired": true,
          "attributeConstraint": "None",
          "isSearchable": false
        }
      ]
    }
    """
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeAttributeOrder",
          "attributes": [
            {
              "type": {
                "name": "lenum",
                "values": [
                  {
                    "key": "enum_key1",
                    "label": {
                      "en": "Enum Key 1"
                    }
                  }
                ]
              },
              "name": "localized_enum",
              "label": {
                "en": "Localized Enum"
              },
              "isRequired": true,
              "attributeConstraint": "None",
              "isSearchable": false
            },
            {
              "type": {
                "name": "enum",
                "values": [
                  {
                    "key": "enum_key1",
                    "label": "Enum Key 1"
                    }
                  }
                ]
              },
              "name": "enum",
              "label": {
                "en": "Enum"
              },
              "isRequired": true,
              "attributeConstraint": "None",
              "isSearchable": false
            }
          ]
        }
      ]
    }
    """

  Scenario: change order of plain enum values in an enum attribute definition
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    And add the "changePlainEnumValueOrder" action to "productType" with values
    """
    {
      "action": "changePlainEnumValueOrder",
      "attributeName": "plain_enum",
      "values": [
        {
          "key": "enum_key2",
          "label": "Enum Key 2"
        },
        {
          "key": "enum_key1",
          "label": "Enum Key 1"
        }
      ]
    }
    """
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changePlainEnumValueOrder",
          "attributeName": "plain_enum",
          "values": [
            {
              "key": "enum_key2",
              "label": "Enum Key 2"
            },
            {
              "key": "enum_key1",
              "label": "Enum Key 1"
            }
          ]
        }
      ]
    }
    """

  Scenario: change order of localized enum values in an localizable enum attribute definition
    Given a "productType" is identified by "id" and version 1
    And i want to update a "productType"
    And add the "changeLocalizedEnumValueOrder" action to "productType" with values
    """
    {
      "action": "changeLocalizedEnumValueOrder",
      "attributeName": "plain_enum",
      "values": [
        {
          "key": "enum_key2",
          "label": {
            "en": "Enum Key 2"
          }
        },
        {
          "key": "enum_key1",
          "label": {
            "en": "Enum Key 1"
          }
        }
      ]
    }
    """
    Then the path should be "product-types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeLocalizedEnumValueOrder",
          "attributeName": "plain_enum",
          "values": [
            {
              "key": "enum_key2",
              "label": {
                "en": "Enum Key 2"
              }
            },
            {
              "key": "enum_key1",
              "label": {
                "en": "Enum Key 1"
              }
            }
          ]
        }
      ]
    }
    """
