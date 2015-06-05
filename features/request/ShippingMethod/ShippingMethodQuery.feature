Feature: I want to query shipping methods
  Scenario: Fetch a shippingMethod by id
    Given a "shippingMethod" is identified by "id"
    Given i want to fetch a "shippingMethod"
    Then the path should be "/shipping-methods/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "shippingMethods"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/shipping-methods?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "shippingMethods"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/shipping-methods?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "shippingMethods"
    And limit the result to "10"
    Then the path should be "/shipping-methods?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "shippingMethods"
    And offset the result with "10"
    Then the path should be "/shipping-methods?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "shippingMethods"
    And sort them by "name"
    Then the path should be "/shipping-methods?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "shippingMethods"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "/shipping-methods?offset=10&sort=name"
    And the method should be "GET"
