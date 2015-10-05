Feature: I want to query payments
  Scenario: Fetch a payment by id
    Given a "payment" is identified by "id"
    Given i want to fetch a "payment"
    Then the path should be "payments/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "payments"
    And filter them with criteria 'name="Peter"'
    Then the path should be "payments?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "payments"
    And filter them with criteria 'name="Peter"'
    Then the path should be "payments?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "payments"
    And limit the result to "10"
    Then the path should be "payments?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "payments"
    And offset the result with "10"
    Then the path should be "payments?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "payments"
    And sort them by "name"
    Then the path should be "payments?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "payments"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "payments?offset=10&sort=name"
    And the method should be "GET"
