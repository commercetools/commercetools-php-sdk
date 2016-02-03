Feature: I want to delete a review
  Scenario: Delete state
    Given a "review" is identified by "id" and version 1
    And i want to delete a "review"
    Then the path should be "reviews/id?version=1"
    And the method should be "DELETE"
