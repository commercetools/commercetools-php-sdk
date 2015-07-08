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

  Scenario:  Set Title
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "setTitle" action to "review" with values
    """
    {
      "action": "setTitle",
      "title": "My review"
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
          "title": "My review"
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

  Scenario:  Set score
    Given a "review" is identified by "id" and version 1
    And i want to update a "review"
    And add the "setScore" action to "review" with values
    """
    {
      "action": "setScore",
      "score": 5
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
          "action": "setScore",
          "score": 5
        }
      ]
    }
    """
