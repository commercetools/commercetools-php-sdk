Feature: I want to update a category
  Scenario: Change category name
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i want to update a "Category"
    And i have a localized "en" "name" with value "New name"
    When i "change" the "name" with these values
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeName",
          "name": {
            "en": "New name"
          }
        }
      ]
    }
    """

  Scenario: Change category slug
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i want to update a "Category"
    And i have a localized "en" "slug" with value "new-slug"
    When i "change" the "slug" with these values
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeSlug",
          "slug": {
            "en": "new-slug"
          }
        }
      ]
    }
    """

  Scenario: Change category parent
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i want to update a "Category"
    And i have a "category" reference to "newParent"
    When i "change" the "parent" with these values
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeParent",
          "parent": {
            "typeId": "category",
            "id": "newParent"
          }
        }
      ]
    }
    """

  Scenario: Change category description
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i want to update a "Category"
    And i have a localized "en" "description" with value "Lorem ipsum"
    When i "set" the "description" with these values
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setDescription",
          "description": {
            "en": "Lorem ipsum"
          }
        }
      ]
    }
    """

  Scenario: Set external id
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i want to update a "Category"
    And i have the "externalId" with value "category-1"
    When i "set" the "ExternalId" with these values
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setExternalId",
          "externalId": "category-1"
        }
      ]
    }
    """

  Scenario: Change order hint
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i want to update a "Category"
    And i have the "orderHint" with value "number1"
    When i "change" the "OrderHint" with these values
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeOrderHint",
          "orderHint": "number1"
        }
      ]
    }
    """
