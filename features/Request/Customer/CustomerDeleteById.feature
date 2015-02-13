Feature: I want to delete a customer
  Scenario: Delete customer
    Given i want to delete a "Customer" identified by "id" and at version "version"
    Then the path should be "customers/id"
    And the method should be "DELETE"
    And the request should be
    """
    {
      "version": "version"
    }
    """
