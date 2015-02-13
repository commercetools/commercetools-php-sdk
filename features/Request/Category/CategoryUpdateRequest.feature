Feature: I want to update a category
  Scenario: Change category name
    Given i want to update a "Category"
    When i "change" the localized "en" "name" to "New name"
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
    Given i want to update a "Category"
    When i "change" the localized "en" "slug" to "new-slug"
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
    Given i want to update a "Category"
    When i "change" the "parent" "category" reference to "newParent"
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
    Given i want to update a "Category"
    When i "set" the localized "en" "description" to "Lorem ipsum"
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
