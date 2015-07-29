Feature: I want to update a comment
  Scenario: Empty update
    Given a "comment" is identified by "id" and version 1
    Given i want to update a "comment"
    Then the path should be "comments/id"
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
    Given a "comment" is identified by "id" and version 1
    And i want to update a "comment"
    And add the "setAuthorName" action to "comment" with values
    """
    {
      "action": "setAuthorName",
      "authorName": "John Doe"
    }
    """
    Then the path should be "comments/id"
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
    Given a "comment" is identified by "id" and version 1
    And i want to update a "comment"
    And add the "setTitle" action to "comment" with values
    """
    {
      "action": "setTitle",
      "title": "My Comment"
    }
    """
    Then the path should be "comments/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setTitle",
          "title": "My Comment"
        }
      ]
    }
    """

  Scenario:  Set Text
    Given a "comment" is identified by "id" and version 1
    And i want to update a "comment"
    And add the "setText" action to "comment" with values
    """
    {
      "action": "setText",
      "text": "Lorem Ipsum"
    }
    """
    Then the path should be "comments/id"
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
