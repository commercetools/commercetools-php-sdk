Feature: I want to query tax categories
  Scenario: Fetch a taxCategory by id
    Given a "taxCategory" is identified by "id"
    Given i want to fetch a "taxCategory"
    Then the path should be "tax-categories/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "taxCategories"
    And filter them with criteria 'name="Peter"'
    Then the path should be "tax-categories?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "taxCategories"
    And filter them with criteria 'name="Peter"'
    Then the path should be "tax-categories?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "taxCategories"
    And limit the result to "10"
    Then the path should be "tax-categories?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "taxCategories"
    And offset the result with "10"
    Then the path should be "tax-categories?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "taxCategories"
    And sort them by "name"
    Then the path should be "tax-categories?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "taxCategories"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "tax-categories?offset=10&sort=name"
    And the method should be "GET"
