Feature: I want to query channels
  Scenario: Fetch a channel by id
    Given a "channel" is identified by "id"
    Given i want to fetch a "channel"
    Then the path should be "/channels/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "channels"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/channels?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "channels"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/channels?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "channels"
    And limit the result to "10"
    Then the path should be "/channels?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "channels"
    And offset the result with "10"
    Then the path should be "/channels?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "channels"
    And sort them by "name"
    Then the path should be "/channels?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "channels"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "/channels?offset=10&sort=name"
    And the method should be "GET"
