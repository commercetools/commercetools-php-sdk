Feature: I want to query zones
  Scenario: Fetch a zone by id
    Given a "zone" is identified by "id"
    Given i want to fetch a "zone"
    Then the path should be "zones/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "zones"
    And filter them with criteria 'name="Peter"'
    Then the path should be "zones?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "zones"
    And filter them with criteria 'name="Peter"'
    Then the path should be "zones?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "zones"
    And limit the result to "10"
    Then the path should be "zones?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "zones"
    And offset the result with "10"
    Then the path should be "zones?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "zones"
    And sort them by "name"
    Then the path should be "zones?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "zones"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "zones?offset=10&sort=name"
    And the method should be "GET"
