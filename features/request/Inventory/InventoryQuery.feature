Feature: I want to query inventory
  Scenario: Fetch a inventory by id
    Given a "inventory" is identified by "id"
    Given i want to fetch a "inventory"
    Then the path should be "/inventory/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "inventory"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/inventory?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "inventory"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/inventory?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "inventory"
    And limit the result to "10"
    Then the path should be "/inventory?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "inventory"
    And offset the result with "10"
    Then the path should be "/inventory?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "inventory"
    And sort them by "name"
    Then the path should be "/inventory?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "inventory"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "/inventory?offset=10&sort=name"
    And the method should be "GET"
