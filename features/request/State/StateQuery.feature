Feature: I want to query states
  Scenario: Fetch a state by id
    Given a "state" is identified by "id"
    Given i want to fetch a "state"
    Then the path should be "states/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "states"
    And filter them with criteria 'name="Peter"'
    Then the path should be "states?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "states"
    And filter them with criteria 'name="Peter"'
    Then the path should be "states?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "states"
    And limit the result to "10"
    Then the path should be "states?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "states"
    And offset the result with "10"
    Then the path should be "states?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "states"
    And sort them by "name"
    Then the path should be "states?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "states"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "states?offset=10&sort=name"
    And the method should be "GET"
