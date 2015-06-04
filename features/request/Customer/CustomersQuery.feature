Feature: I want to query customers
  Scenario: Fetch a customer by id
    Given a "customer" is identified by "id"
    When i want to fetch a "Customer"
    Then the path should be "/customers/id"
    And the method should be "GET"

  Scenario: Query customers
    Given i want to query "Customers"
    Then the path should be "/customers"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "Customers"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/customers?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "Customers"
    And limit the result to "10"
    Then the path should be "/customers?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "Customers"
    And offset the result with "10"
    Then the path should be "/customers?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "Customers"
    And sort them by "name"
    Then the path should be "/customers?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "Customers"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "/customers?offset=10&sort=name"
    And the method should be "GET"
