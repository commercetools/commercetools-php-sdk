Feature: I want to create a new customer group
  Background:
    Given i have a customerGroup draft
    And the groupName is "myCustomerGroup"

  Scenario: create a customer group
    When i want to create a "customerGroup"
    Then the path should be "/customer-groups"
    And the method should be "POST"
    And the request should be
    """
    {
      "groupName": "myCustomerGroup"
    }
    """
