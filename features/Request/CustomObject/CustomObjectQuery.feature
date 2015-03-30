Feature: I want to query customObjects
  Scenario: Fetch a customObject by id
    Given a "customObject" is identified by "container" and "key"
    Given i want to fetch a "customObject" by key
    Then the path should be "custom-objects/container/key"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "customObjects"
    And filter them with criteria 'name="Peter"'
    Then the path should be "custom-objects?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "customObjects"
    And filter them with criteria 'name="Peter"'
    Then the path should be "custom-objects?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "customObjects"
    And limit the result to "10"
    Then the path should be "custom-objects?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "customObjects"
    And offset the result with "10"
    Then the path should be "custom-objects?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "customObjects"
    And sort them by "name"
    Then the path should be "custom-objects?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "customObjects"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "custom-objects?offset=10&sort=name"
    And the method should be "GET"
