Feature: I want to update a category
  Background:
    Given a "category" is identified by "id" and "version"

  Scenario: Change category name
    Given i want to "changeName" of "category"
    And the name is "New name" in "en"
    Given i want to "changeSlug" of "category"
    And the slug is "new-slug" in "en"
    When i want to update a "Category"
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
        },
        {
          "action": "changeSlug",
          "slug": {
            "en": "new-slug"
          }
        }
      ]
    }
    """

  Scenario: Change category slug
    Given i want to "changeSlug" of "category"
    And the slug is "new-slug" in "en"
    When i want to update a "Category"
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
    Given i want to "changeParent" of "category"
    And the "category" reference "parent" is "newParent"
    And i want to update a "Category"
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
    Given i want to "setDescription" of "category"
    And the description is "Lorem ipsum" in "en"
    When i want to update a "Category"
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
    Given i want to "setExternalId" of "category"
    And the externalId is "category-1"
    When i want to update a "Category"
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
    Given i want to "changeOrderHint" of "category"
    And the orderHint is "number1"
    When i want to update a "Category"
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

  Scenario:
    Given i want to "setMetaTitle" of "category"
    And set the "metaTitle" to "metaTitle" in "en"
    When i want to update a "Category"
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setMetaTitle",
          "metaTitle": {
            "en": "metaTitle"
          }
        }
      ]
    }
    """

  Scenario:
    Given i want to "setMetaDescription" of "category"
    And set the "metaDescription" to "metaDescription" in "en"
    When i want to update a "Category"
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setMetaDescription",
          "metaDescription": {
            "en": "metaDescription"
          }
        }
      ]
    }
    """

  Scenario:
    Given i want to "setMetaKeywords" of "category"
    And set the "metaKeywords" to "metaKeywords" in "en"
    When i want to update a "Category"
    Then the path should be "categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setMetaKeywords",
          "metaKeywords": {
            "en": "metaKeywords"
          }
        }
      ]
    }
    """
