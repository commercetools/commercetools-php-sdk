Feature: I want to create a new review
  Background:
    Given i have a review draft
    And the productId is "my-product-id-1"
    And the customerId is "my-customer-id-1"
    And set the authorName to "Customer 1"
    And set the title to "My Review"
    And set the text to "Lorem Ipsum"
    And set the score to 0.8 as float

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
