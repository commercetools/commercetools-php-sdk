Feature: I want to query categories
  Scenario: Fetch a category by id
    Given a "category" is identified by "id"
    Given i want to fetch a "category"
    Then the path should be "categories/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "categories"
    And filter them with criteria 'name="Peter"'
    Then the path should be "categories?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "categories"
    And filter them with criteria 'name="Peter"'
    Then the path should be "categories?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "categories"
    And limit the result to "10"
    Then the path should be "categories?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "categories"
    And offset the result with "10"
    Then the path should be "categories?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "categories"
    And sort them by "name"
    Then the path should be "categories?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "categories"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "categories?offset=10&sort=name"
    And the method should be "GET"
