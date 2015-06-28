Feature: I want to update a category
  Scenario: Change category name
    Given a "category" is identified by "id" and version "1"
    And i want to update a "category"
    And add the "changeName" action to "category" with values
    """
        {
          "action": "changeName",
          "name": {
            "en": "New name"
          }
        }
    """
    And add the "changeSlug" action to "category" with values
    """
        {
          "action": "changeSlug",
          "slug": {
            "en": "new-slug"
          }
        }
    """
    Then the path should be "/categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Given a "category" is identified by "id" and version "1"
    And i want to update a "category"
    And add the "changeSlug" action to "category" with values
    """
        {
          "action": "changeSlug",
          "slug": {
            "en": "new-slug"
          }
        }
    """
    Then the path should be "/categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Given a "category" is identified by "id" and version "1"
    And i want to update a "category"
    And add the "changeParent" action to "category" with values
    """
        {
          "action": "changeParent",
          "parent": {
            "typeId": "category",
            "id": "newParent"
          }
        }
    """
    Then the path should be "/categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Given a "category" is identified by "id" and version "1"
    And i want to update a "category"
    And add the "setDescription" action to "category" with values
    """
        {
          "action": "setDescription",
          "description": {
            "en": "Lorem ipsum"
          }
        }
    """
    Then the path should be "/categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Given a "category" is identified by "id" and version "1"
    And i want to update a "category"
    And add the "setExternalId" action to "category" with values
    """
        {
          "action": "setExternalId",
          "externalId": "category-1"
        }
    """
    Then the path should be "/categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setExternalId",
          "externalId": "category-1"
        }
      ]
    }
    """

  Scenario: Change order hint
    Given a "category" is identified by "id" and version "1"
    And i want to update a "category"
    And add the "changeOrderHint" action to "category" with values
    """
        {
          "action": "changeOrderHint",
          "orderHint": "number1"
        }
    """
    Then the path should be "/categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeOrderHint",
          "orderHint": "number1"
        }
      ]
    }
    """

  Scenario:
    Given a "category" is identified by "id" and version "1"
    And i want to update a "category"
    And add the "setMetaTitle" action to "category" with values
    """
        {
          "action": "setMetaTitle",
          "metaTitle": {
            "en": "metaTitle"
          }
        }
    """
    Then the path should be "/categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Given a "category" is identified by "id" and version "1"
    And i want to update a "category"
    And add the "setMetaDescription" action to "category" with values
    """
        {
          "action": "setMetaDescription",
          "metaDescription": {
            "en": "metaDescription"
          }
        }
    """
    Then the path should be "/categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Given a "category" is identified by "id" and version "1"
    And i want to update a "category"
    And add the "setMetaKeywords" action to "category" with values
    """
        {
          "action": "setMetaKeywords",
          "metaKeywords": {
            "en": "metaKeywords"
          }
        }
    """
    Then the path should be "/categories/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
