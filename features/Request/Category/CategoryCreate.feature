Feature: I want to create a new category
  Scenario: create a category with name and slug
    Given i have a "category" draft
    And the localized "en" "name" is "myCategory"
    And the localized "en" "slug" is "my-category"
    And i want to create a "category"
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
