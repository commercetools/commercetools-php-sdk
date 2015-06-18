Feature: I want to query discount codes
  Scenario: Fetch a discountCode by id
    Given a "discountCode" is identified by "id"
    Given i want to fetch a "discountCode"
    Then the path should be "/discount-codes/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "discountCodes"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/discount-codes?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "discountCodes"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/discount-codes?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "discountCodes"
    And limit the result to "10"
    Then the path should be "/discount-codes?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "discountCodes"
    And offset the result with "10"
    Then the path should be "/discount-codes?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "discountCodes"
    And sort them by "name"
    Then the path should be "/discount-codes?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "discountCodes"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "/discount-codes?offset=10&sort=name"
    And the method should be "GET"
