Feature: I want to create a new type
  Background:
    Given i have a "type" draft with values
    """
    {
      "key": "myType",
      "name": {
        "en": "My Type"
      },
      "description": {
        "en": "My Type description"
      },
      "resourceTypeIds": ["category"],
      "fieldDefinitions": [
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

  Scenario: create a tax category
    When i want to create a "type"
    Then the path should be "types"
    And the method should be "POST"
    And the request should be
    """
    {
      "key": "myType",
      "name": {
        "en": "My Type"
      },
      "description": {
        "en": "My Type description"
      },
      "resourceTypeIds": ["category"],
      "fieldDefinitions": [
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
