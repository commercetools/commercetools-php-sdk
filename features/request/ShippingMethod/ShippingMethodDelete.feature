Feature: I want to delete a shipping method
  Scenario: Delete shippingMethod
    Given a "shippingMethod" is identified by "id" and version 1
    And i want to delete a "shippingMethod"
    Then the path should be "shipping-methods/id?version=1"
    And the method should be "DELETE"
