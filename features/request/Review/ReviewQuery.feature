Feature: I want to query reviews
  Scenario: Fetch a review by id
    Given a "review" is identified by "id"
    Given i want to fetch a "review"
    Then the path should be "/reviews/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "reviews"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/reviews?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "reviews"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/reviews?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "reviews"
    And limit the result to "10"
    Then the path should be "/reviews?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "reviews"
    And offset the result with "10"
    Then the path should be "/reviews?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "reviews"
    And sort them by "name"
    Then the path should be "/reviews?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "reviews"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "/reviews?offset=10&sort=name"
    And the method should be "GET"
