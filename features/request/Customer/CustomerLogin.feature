Feature: I want to create a new customer
  Scenario: signin a customer
    When i want to signin a "customer" with email "john.doe@example.org", password "secretPassword" and anonymousCartId "abc1234"
    Then the path should be "/login"
    And the method should be "POST"
    And the request should be
    """
    {
      "email": "john.doe@example.org",
      "password": "secretPassword",
      "anonymousCartId": "abc1234"
    }
    """
