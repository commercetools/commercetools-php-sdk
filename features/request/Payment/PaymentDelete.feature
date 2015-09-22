Feature: I want to delete a product discount
  Scenario: Delete product discount
    Given a "payment" is identified by "id" and version 1
    And i want to delete a "payment"
    Then the path should be "payments/id?version=1"
    And the method should be "DELETE"
