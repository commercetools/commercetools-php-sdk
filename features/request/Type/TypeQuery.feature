Feature: I want to query types
  Scenario: Fetch a type by id
    Given a "type" is identified by "id"
    Given i want to fetch a "type"
    Then the path should be "types/id"
    And the method should be "GET"

  Scenario: Query types with filter applied
    Given i want to query "types"
    And filter them with criteria 'name="Peter"'
    Then the path should be "types?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query types with filter applied
    Given i want to query "types"
    And filter them with criteria 'name="Peter"'
    Then the path should be "types?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query types with limit
    Given i want to query "types"
    And limit the result to "10"
    Then the path should be "types?limit=10"
    And the method should be "GET"

  Scenario: Query types with offset
    Given i want to query "types"
    And offset the result with "10"
    Then the path should be "types?offset=10"
    And the method should be "GET"

  Scenario: Query types sorted
    Given i want to query "types"
    And sort them by "name"
    Then the path should be "types?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "types"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "types?offset=10&sort=name"
    And the method should be "GET"
