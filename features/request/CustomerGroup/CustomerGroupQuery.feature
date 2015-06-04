Feature: I want to query customerGroup
  Scenario: Fetch a customerGroup by id
    Given a "customerGroup" is identified by "id"
    Given i want to fetch a "customerGroup"
    Then the path should be "/customer-groups/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "customerGroups"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/customer-groups?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "customerGroups"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/customer-groups?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "customerGroups"
    And limit the result to "10"
    Then the path should be "/customer-groups?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "customerGroups"
    And offset the result with "10"
    Then the path should be "/customer-groups?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "customerGroups"
    And sort them by "name"
    Then the path should be "/customer-groups?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "customerGroups"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "/customer-groups?offset=10&sort=name"
    And the method should be "GET"
