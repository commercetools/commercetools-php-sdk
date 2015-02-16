Feature: I want to delete a customer
  Scenario: Delete customer
    Given i have the "id" with value "id"
    And i have the "version" with value "version"
    And i want to delete a "Customer"
    Then the path should be "customers/id"
    And the method should be "DELETE"
    And the request should be
    """
    {
      "version": "version"
    }
    """
