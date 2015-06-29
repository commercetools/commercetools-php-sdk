Feature: I want to create a new category
  Scenario: create a category
    Given i have a "category" draft with values
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
    When i want to create a "category"
    Then the path should be "/categories"
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
