Feature: I want to query carts
  Scenario: Fetch a cart by id
    Given i have the "id" with value "id"
    Given i want to fetch a "Cart"
    Then the path should be "carts/id"
    And the method should be "GET"

  Scenario: Query carts
    Given i want to query "Carts"
    And query by customers id "id"
    Then the path should be "carts?customerId=id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "Carts"
    And filter them with criteria 'name="Peter"'
    Then the path should be "carts?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "Carts"
    And filter them with criteria 'name="Peter"'
    Then the path should be "carts?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "Carts"
    And limit the result to "10"
    Then the path should be "carts?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "Carts"
    And offset the result with "10"
    Then the path should be "carts?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "Carts"
    And sort them by "name"
    Then the path should be "carts?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "Carts"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "carts?offset=10&sort=name"
    And the method should be "GET"
