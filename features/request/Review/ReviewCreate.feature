Feature: I want to create a new review
  Background:
    Given i have a "review" draft with values
    """
    {
      "productId": "my-product-id-1",
      "customerId": "my-customer-id-1",
      "authorName": "Customer 1",
      "title": "My Review",
      "text": "Lorem Ipsum",
      "score": 0.8
    }
    """

  Scenario: create a review
    When i want to create a "review"
    Then the path should be "reviews"
    And the method should be "POST"
    And the request should be
    """
    {
      "productId": "my-product-id-1",
      "customerId": "my-customer-id-1",
      "authorName": "Customer 1",
      "title": "My Review",
      "text": "Lorem Ipsum",
      "score": 0.8
    }
    """
