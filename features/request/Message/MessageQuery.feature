Feature: I want to query messages
  Scenario: Fetch a message by id
    Given a "message" is identified by "id"
    Given i want to fetch a "message"
    Then the path should be "/messages/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "messages"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/messages?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "messages"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/messages?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "messages"
    And limit the result to "10"
    Then the path should be "/messages?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "messages"
    And offset the result with "10"
    Then the path should be "/messages?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "messages"
    And sort them by "name"
    Then the path should be "/messages?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "messages"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "/messages?offset=10&sort=name"
    And the method should be "GET"
