Feature: I want to query products
  Scenario: Fetch a product by id
    Given a "product" is identified by "id"
    Given i want to fetch a "product"
    Then the path should be "/products/id"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "products"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/products?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with filter applied
    Given i want to query "products"
    And filter them with criteria 'name="Peter"'
    Then the path should be "/products?where=name%3D%22Peter%22"
    And the method should be "GET"

  Scenario: Query customers with limit
    Given i want to query "products"
    And limit the result to "10"
    Then the path should be "/products?limit=10"
    And the method should be "GET"

  Scenario: Query customers with offset
    Given i want to query "products"
    And offset the result with "10"
    Then the path should be "/products?offset=10"
    And the method should be "GET"

  Scenario: Query customers sorted
    Given i want to query "products"
    And sort them by "name"
    Then the path should be "/products?sort=name"
    And the method should be "GET"

  Scenario: Query parameters should be sorted
    Given i want to query "products"
    And sort them by "name"
    And offset the result with "10"
    Then the path should be "/products?offset=10&sort=name"
    And the method should be "GET"
