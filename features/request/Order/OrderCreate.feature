Feature: I want to create a new order

  Scenario: create an order from cart
    Given a "cart" is identified by "id" and version 1
    And i want to create a "order" from "cart"
    And set the orderNumber to "orderNumber" and the paymentState to "Paid"
    Then the path should be "orders"
    And the method should be "POST"
    And the request should be
    """
    {
      "id": "id",
      "version": 1,
      "orderNumber": "orderNumber",
      "paymentState": "Paid"
    }
    """
