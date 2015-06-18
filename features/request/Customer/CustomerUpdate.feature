Feature: I want to send a Customer Update Request
  Background:
    Given a "customer" is identified by "id" and "version"
    Given i have a "common" "address" object as "default"
    And set the "email" to "john.doe@company.com"
    And set the "firstName" to "John"
    And set the "lastName" to "Doe"
    Given i have a "common" "address" object as "jane"
    And set the "email" to "jane.doe@company.com"
    And set the "firstName" to "Jane"
    And set the "lastName" to "Doe"

  Scenario: Change user name and email
    Given i want to "changeName" of "customer"
    And the firstName is "John"
    And the lastName is "Doe"
    Given i want to "changeEmail" of "customer"
    And the email is "john.doe@company.com"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeName",
          "firstName": "John",
          "lastName": "Doe"
        },
        {
          "action": "changeEmail",
          "email": "john.doe@company.com"
        }
      ]
    }
    """

  Scenario: Change user name
    Given i want to "changeName" of "customer"
    And the firstName is "John"
    And the lastName is "Doe"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeName",
          "firstName": "John",
          "lastName": "Doe"
        }
      ]
    }
    """

  Scenario: Change email address
    Given i want to "changeEmail" of "customer"
    And the email is "john.doe@company.com"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeEmail",
          "email": "john.doe@company.com"
        }
      ]
    }
    """

  Scenario: Add an address to customer
    Given i want to "addAddress" of "customer"
    And the "address" is "default" object
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addAddress",
          "address": {
            "email": "john.doe@company.com",
            "firstName": "John",
            "lastName": "Doe"
          }
        }
      ]
    }
    """
  Scenario: Add two addresses to customer
    Given i want to "addAddress" of "customer"
    And the "address" is "default" object
    Given i want to "addAddress" of "customer" as "secondAddress"
    And the "address" is "jane" object
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addAddress",
          "address": {
            "email": "john.doe@company.com",
            "firstName": "John",
            "lastName": "Doe"
          }
        },
        {
          "action": "addAddress",
          "address": {
            "email": "jane.doe@company.com",
            "firstName": "Jane",
            "lastName": "Doe"
          }
        }
      ]
    }
    """
  Scenario: Change a customer's address
    Given i want to "changeAddress" of "customer"
    And the addressId is "addressId-1"
    And the "address" is "default" object
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "changeAddress",
          "addressId": "addressId-1",
          "address": {
            "email": "john.doe@company.com",
            "firstName": "John",
            "lastName": "Doe"
          }
        }
      ]
    }
    """
  Scenario: Remove a customer's address
    Given i want to "removeAddress" of "customer"
    And the addressId is "addressId-1"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "removeAddress",
          "addressId": "addressId-1"
        }
      ]
    }
    """

  Scenario: Set customer's default shipping address
    Given i want to "setDefaultShippingAddress" of "customer"
    And set the addressId to "addressId-1"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setDefaultShippingAddress",
          "addressId": "addressId-1"
        }
      ]
    }
    """

  Scenario: Unset customer's default shipping address
    Given i want to "setDefaultShippingAddress" of "customer"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setDefaultShippingAddress"
        }
      ]
    }
    """

  Scenario: Set customer's default billing address
    Given i want to "setDefaultBillingAddress" of "customer"
    And set the addressId to "addressId-1"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setDefaultBillingAddress",
          "addressId": "addressId-1"
        }
      ]
    }
    """
  Scenario: Unset customer's default billing address
    Given i want to "setDefaultBillingAddress" of "customer"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setDefaultBillingAddress"
        }
      ]
    }
    """

  Scenario: Set customer group
    Given i want to "setCustomerGroup" of "customer"
    And set the "customerGroup" reference "customerGroup" to "myCustomerGroup"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setCustomerGroup",
          "customerGroup": {
            "typeId": "customer-group",
            "id": "myCustomerGroup"
          }
        }
      ]
    }
    """

  Scenario: Set customer number
    Given i want to "setCustomerNumber" of "customer"
    And set the "customerNumber" to "customer-1"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setCustomerNumber",
          "customerNumber": "customer-1"
        }
      ]
    }
    """

  Scenario: Set external id
    Given i want to "setExternalId" of "customer"
    And set the "externalId" to "customer-1"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setExternalId",
          "externalId": "customer-1"
        }
      ]
    }
    """

  Scenario: Set company name
    Given i want to "setCompanyName" of "customer"
    And set the "companyName" to "myCompany"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setCompanyName",
          "companyName": "myCompany"
        }
      ]
    }
    """

  Scenario: Set Date of Birth
    Given i want to "setDateOfBirth" of "customer"
    And set the "DateOfBirth" date to "2014-10-15 15:00"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setDateOfBirth",
          "dateOfBirth": "2014-10-15"
        }
      ]
    }
    """

  Scenario: Set Vat Id
    Given i want to "setVatId" of "customer"
    And set the "vatId" to "myVatId"
    When i want to update a "Customer"
    Then the path should be "/customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setVatId",
          "vatId": "myVatId"
        }
      ]
    }
    """
