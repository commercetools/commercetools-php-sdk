Feature: I want to create a new category
  Background:
    Given i have a category draft
    And the name is "myCategory" in "en"
    And the slug is "my-category" in "en"

  Scenario: create a category
    When i want to create a "category"
    Then the path should be "categories"
    And the method should be "POST"
    And the request should be
    """
    {
      "name": {
        "en": "myCategory"
      },
      "slug": {
        "en": "my-category"
      }
    }
    """
