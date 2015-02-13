Feature: I want to send a Customer Update Request
  Scenario: Change user name
    Given i want to update a "Customer"
    When i have the "firstName" with value "John"
    And i have the "lastName" with value "Doe"
    And i "change" the "name" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    When i have the "email" with value "john.doe@company.com"
    And i "change" the "email" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i have the "common" object "address"
    And set the objects "firstName" to "John"
    And set the objects "lastName" to "Doe"
    And i "add" the "address" with these values
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addAddress",
          "address": {
            "firstName": "John",
            "lastName": "Doe"
          }
        }
      ]
    }
    """
  Scenario: Add two addresses to customer
    Given i want to update a "Customer"
    And i have the "common" object "address"
    And set the objects "firstName" to "John"
    And set the objects "lastName" to "Doe"
    And i "add" the "address" with these values
    And i have the "common" object "address"
    And set the objects "firstName" to "Jane"
    And set the objects "lastName" to "Doe"
    And i "add" the "address" with these values
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addAddress",
          "address": {
            "firstName": "John",
            "lastName": "Doe"
          }
        },
        {
          "action": "addAddress",
          "address": {
            "firstName": "Jane",
            "lastName": "Doe"
          }
        }
      ]
    }
    """
  Scenario: Change a customer's address
    Given i want to update a "Customer"
    And i have the "addressId" with value "addressId-1"
    And i have the "common" object "address"
    And set the objects "firstName" to "John"
    And set the objects "lastName" to "Doe"
    And i "change" the "address" with these values
    Then the path should be "customers/id"
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
            "firstName": "John",
            "lastName": "Doe"
          }
        }
      ]
    }
    """
  Scenario: Remove a customer's address
    Given i want to update a "Customer"
    And i have the "addressId" with value "addressId-1"
    And i "remove" the "address" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i have the "addressId" with value "addressId-1"
    And i "set" the "DefaultShippingAddress" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i "set" the "DefaultShippingAddress" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i have the "addressId" with value "addressId-1"
    And i "set" the "DefaultBillingAddress" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i "set" the "DefaultBillingAddress" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i have a "customerGroup" reference to "myCustomerGroup"
    When i "set" the "CustomerGroup" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i have the "customerNumber" with value "customer-1"
    When i "set" the "CustomerNumber" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i have the "externalId" with value "customer-1"
    When i "set" the "ExternalId" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i have the "companyName" with value "myCompany"
    When i "set" the "CompanyName" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i have the date "2014-10-15 15:00"
    When i "set" the "DateOfBirth" with these values
    Then the path should be "customers/id"
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
    Given i want to update a "Customer"
    And i have the "vatId" with value "myVatId"
    When i "set" the "VatId" with these values
    Then the path should be "customers/id"
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
