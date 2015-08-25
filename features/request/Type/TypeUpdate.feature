Feature: I want to update a type
  Scenario: Empty update
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: Change name of type
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    And add the "changeName" action to "type" with values
    """
    {
      "action": "changeName",
      "name": {
        "en": "New type name"
      }
    }
    """
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeName",
          "name": {
            "en": "New type name"
          }
        }
      ]
    }
    """

  Scenario: Change description
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    And add the "changeDescription" action to "type" with values
    """
    {
      "action": "changeDescription",
      "description": {
        "en": "New description"
      }
    }
    """
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeDescription",
          "description": {
            "en": "New description"
          }
        }
      ]
    }
    """

  Scenario: Add field definition
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    And add the "addFieldDefinition" action to "type" with values
    """
    {
      "action": "addFieldDefinition",
      "fieldDefinition": {
        "type": {
          "name": "String"
        },
        "name": "custom-string",
        "label": {
          "en": "Custom String"
        },
        "isRequired": false,
        "inputHint": "SingleLine"
      }
    }
    """
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addFieldDefinition",
          "fieldDefinition": {
            "type": {
              "name": "String"
            },
            "name": "custom-string",
            "label": {
              "en": "Custom String"
            },
            "isRequired": false,
            "inputHint": "SingleLine"
          }
        }
      ]
    }
    """

  Scenario: Remove field definition
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    And add the "removeFieldDefinition" action to "type" with values
    """
    {
      "action": "removeFieldDefinition",
      "fieldName": "<field-name>"
    }
    """
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeFieldDefinition",
          "fieldName": "<field-name>"
        }
      ]
    }
    """

  Scenario: Change field definition label
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    And add the "changeLabel" action to "type" with values
    """
    {
      "action": "changeLabel",
      "fieldName": "<field-name>",
      "label": {
        "en": "New Label"
      }
    }
    """
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeLabel",
          "fieldName": "<field-name>",
          "label": {
            "en": "New Label"
          }
        }
      ]
    }
    """

  Scenario: Add an Enum Value to a Field Definition
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    And add the "addEnumValue" action to "type" with values
    """
    {
      "action": "addEnumValue",
      "fieldName": "<field-name>",
      "value": {
        "key": "newenum",
        "label": "New Enum"
      }
    }
    """
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addEnumValue",
          "fieldName": "<field-name>",
          "value": {
            "key": "newenum",
            "label": "New Enum"
          }
        }
      ]
    }
    """

  Scenario: Add a localized Enum Value to a Field Definition
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    And add the "addLocalizedEnumValue" action to "type" with values
    """
    {
      "action": "addLocalizedEnumValue",
      "fieldName": "<field-name>",
      "value": {
        "key": "newenum",
        "label": {
          "en": "New Enum"
        }
      }
    }
    """
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addLocalizedEnumValue",
          "fieldName": "<field-name>",
          "value": {
            "key": "newenum",
            "label": {
              "en": "New Enum"
            }
          }
        }
      ]
    }
    """

  Scenario: Change the Order of Field Definitions
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    And add the "changeFieldDefinitionOrder" action to "type" with values
    """
    {
      "action": "changeFieldDefinitionOrder",
      "attributes": [
        {
          "type": {
            "name": "String"
          },
          "name": "custom-string",
          "label": {
            "en": "Custom String"
          },
          "isRequired": false,
          "inputHint": "SingleLine"
        }
      ]
    }
    """
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeFieldDefinitionOrder",
          "attributes": [
            {
              "type": {
                "name": "String"
              },
              "name": "custom-string",
              "label": {
                "en": "Custom String"
              },
              "isRequired": false,
              "inputHint": "SingleLine"
            }
          ]
        }
      ]
    }
    """

  Scenario: Change the Order of Enum Values in an Enum Field Definition
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    And add the "changeEnumValueOrder" action to "type" with values
    """
    {
      "action": "changeEnumValueOrder",
      "fieldName": "<field-name>",
      "values": [{
        "key": "enumkey",
        "label": "Enum Label"
      }]
    }
    """
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeEnumValueOrder",
          "fieldName": "<field-name>",
          "values": [{
            "key": "enumkey",
            "label": "Enum Label"
          }]
        }
      ]
    }
    """

  Scenario: Change the Order of Localized Enum Values in a Localized Enum Field Definition
    Given a "type" is identified by "id" and version 1
    And i want to update a "type"
    And add the "changeLocalizedEnumValueOrder" action to "type" with values
    """
    {
      "action": "changeLocalizedEnumValueOrder",
      "fieldName": "<field-name>",
      "values": [{
        "key": "enumkey",
        "label": {
          "en": "Enum Label"
        }
      }]
    }
    """
    Then the path should be "types/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeLocalizedEnumValueOrder",
          "fieldName": "<field-name>",
          "values": [{
            "key": "enumkey",
            "label": {
              "en": "Enum Label"
            }
          }]
        }
      ]
    }
    """
