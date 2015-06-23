Feature: I want to query comments
  Scenario: Fetch a comment by id
    Given a "comment" is identified by "id"
    Given i want to fetch a "comment"
    Then the path should be "/comments/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "comments"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/comments?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "comments"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/comments?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "comments"
    And limit the result to "10"
    Then the path should be "/comments?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "comments"
    And offset the result with "10"
    Then the path should be "/comments?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "comments"
    And sort them by "name"
    Then the path should be "/comments?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "comments"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "/comments?offset=10&sort=name"
    And the method should be "GET"
