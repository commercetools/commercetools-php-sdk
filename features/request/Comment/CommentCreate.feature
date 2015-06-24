Feature: I want to create a new comment
  Background:
    Given i have a "comment" draft with values
    """
    {
      "productId": "my-product-id-1",
      "customerId": "my-customer-id-1",
      "authorName": "Customer 1",
      "title": "My Comment",
      "text": "Lorem Ipsum"
    }
    """

  Scenario: create a comment
    When i want to create a "comment"
    Then the path should be "/comments"
    And the method should be "POST"
    And the request should be
    """
    {
      "productId": "my-product-id-1",
      "customerId": "my-customer-id-1",
      "authorName": "Customer 1",
      "title": "My Comment",
      "text": "Lorem Ipsum"
    }
    """
