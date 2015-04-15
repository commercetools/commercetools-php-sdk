Feature: I want to query orders
  Scenario: Fetch a order by id
    Given a "order" is identified by "id"
    When i want to fetch a "Order"
    Then the path should be "orders/id"
    And the method should be "GET"

  Scenario: Query orders
    Given i want to query "Orders"
    Then the path should be "orders"
    And the method should be "GET"

  Scenario: Query orders with filter applied
    Given i want to query "Orders"
    And filter them with criteria 'name="Peter"'
    Then the path should be "orders?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query orders with limit
    Given i want to query "Orders"
    And limit the result to "10"
    Then the path should be "orders?limit=10"
    And the method should be "GET"

  Scenario: Query orders with offset
    Given i want to query "Orders"
    And offset the result with "10"
    Then the path should be "orders?offset=10"
    And the method should be "GET"

  Scenario: Query orders sorted
    Given i want to query "Orders"
    And sort them by "name"
    Then the path should be "orders?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "Orders"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "orders?offset=10&sort=name"
    And the method should be "GET"
