Feature: I want to update a review
  Scenario: Empty update
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    Then the path should be "reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario: Empty update
    Given a "review" is identified by key "review1" and version 1
    And i want to update a "review"
    Then the path should be "reviews/key=review1"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
      ]
    }
    """

  Scenario:  Set Key
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "setKey" action to "review" with values
    """
    {
      "action": "setKey",
      "key": "review1"
    }
    """
    Then the path should be "reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setKey",
          "key": "review1"
        }
      ]
    }
    """

  Scenario:  Set Author Name
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "setAuthorName" action to "review" with values
    """
    {
      "action": "setAuthorName",
      "authorName": "John Doe"
    }
    """
    Then the path should be "reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setAuthorName",
          "authorName": "John Doe"
        }
      ]
    }
    """

  Scenario:  Set Customer
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "setCustomer" action to "review" with values
    """
    {
      "action": "setCustomer",
      "customer": {
        "typeId": "customer",
        "id": "customer1"
      }
    }
    """
    Then the path should be "reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setCustomer",
          "customer": {
            "typeId": "customer",
            "id": "customer1"
          }
        }
      ]
    }
    """

  Scenario:  Set rating
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "setRating" action to "review" with values
    """
    {
      "action": "setRating",
      "rating": 5
    }
    """
    Then the path should be "reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setRating",
          "rating": 5
        }
      ]
    }
    """

  Scenario:  Set Target
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "setTarget" action to "review" with values
    """
    {
      "action": "setTarget",
      "target":  {
        "typeId": "product",
        "id": "product1"
      }
    }
    """
    Then the path should be "reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setTarget",
          "target":  {
            "typeId": "product",
            "id": "product1"
          }
        }
      ]
    }
    """

  Scenario:  Set Text
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "setText" action to "review" with values
    """
    {
      "action": "setText",
      "text": "Lorem Ipsum"
    }
    """
    Then the path should be "reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setText",
          "text": "Lorem Ipsum"
        }
      ]
    }
    """

  Scenario:  Set title
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "setTitle" action to "review" with values
    """
    {
      "action": "setTitle",
      "title": "Lorem Ipsum"
    }
    """
    Then the path should be "reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setTitle",
          "title": "Lorem Ipsum"
        }
      ]
    }
    """

  Scenario:  Set locale
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "setLocale" action to "review" with values
    """
    {
      "action": "setLocale",
      "locale": "en_US"
    }
    """
    Then the path should be "reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setLocale",
          "locale": "en_US"
        }
      ]
    }
    """

  Scenario: Transition state
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "transitionState" action to "review" with values
    """
    {
      "action": "transitionState",
      "state": {
        "typeId": "state",
        "id": "state1"
      },
      "force": false
    }
    """
    Then the path should be "reviews/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "transitionState",
          "state": {
            "typeId": "state",
            "id": "state1"
          },
          "force": false
        }
      ]
    }
    """
