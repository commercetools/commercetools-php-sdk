Feature: I want to create a new customer
  Scenario: signin a customer
    Given a "customer" is identified by the email "john.doe@company.com"
    And the password is "secretPassword"
    And the anonymousCartId is "abc1234"
    When i want to signin a "customer"
    Then the path should be "/login"
    And the method should be "POST"
    And the request should be
    """
    {
      "email": "john.doe@company.com",
      "password": "secretPassword",
      "anonymousCartId": "abc1234"
    }
    """
