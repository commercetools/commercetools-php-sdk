Feature: I want to query productDiscounts
  Scenario: Fetch a productDiscount by id
    Given a "productDiscount" is identified by "id"
    Given i want to fetch a "productDiscount"
    Then the path should be "product-discounts/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "productDiscounts"
    And filter them with criteria 'name="Peter"'
    Then the path should be "product-discounts?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "productDiscounts"
    And filter them with criteria 'name="Peter"'
    Then the path should be "product-discounts?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "productDiscounts"
    And limit the result to "10"
    Then the path should be "product-discounts?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "productDiscounts"
    And offset the result with "10"
    Then the path should be "product-discounts?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "productDiscounts"
    And sort them by "name"
    Then the path should be "product-discounts?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "productDiscounts"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "product-discounts?offset=10&sort=name"
    And the method should be "GET"
