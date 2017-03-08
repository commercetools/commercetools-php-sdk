Feature: I want to send a Customer Update Request

  Scenario: Change user name and email
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setFirstName" action to "customer" with values
    """
        {
          "action": "setFirstName",
          "firstName": "John"
        }
    """
    And add the "changeEmail" action to "customer" with values
    """
        {
          "action": "changeEmail",
          "email": "john.doe@example.org"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setFirstName",
          "firstName": "John"
        },
        {
          "action": "changeEmail",
          "email": "john.doe@example.org"
        }
      ]
    }
    """

  Scenario: Change email address
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "changeEmail" action to "customer" with values
    """
        {
          "action": "changeEmail",
          "email": "john.doe@example.org"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeEmail",
          "email": "john.doe@example.org"
        }
      ]
    }
    """

  Scenario: Add an address to customer
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "addAddress" action to "customer" with values
    """
        {
          "action": "addAddress",
          "address": {
            "email": "john.doe@example.org",
            "firstName": "John",
            "lastName": "Doe"
          }
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addAddress",
          "address": {
            "email": "john.doe@example.org",
            "firstName": "John",
            "lastName": "Doe"
          }
        }
      ]
    }
    """
  Scenario: Add two addresses to customer
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "addAddress" action to "customer" with values
    """
        {
          "action": "addAddress",
          "address": {
            "email": "john.doe@example.org",
            "firstName": "John",
            "lastName": "Doe"
          }
        }
    """
    And add the "addAddress" action to "customer" with values
    """
        {
          "action": "addAddress",
          "address": {
            "email": "jane.doe@example.org",
            "firstName": "Jane",
            "lastName": "Doe"
          }
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addAddress",
          "address": {
            "email": "john.doe@example.org",
            "firstName": "John",
            "lastName": "Doe"
          }
        },
        {
          "action": "addAddress",
          "address": {
            "email": "jane.doe@example.org",
            "firstName": "Jane",
            "lastName": "Doe"
          }
        }
      ]
    }
    """
  Scenario: Change a customer's address
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "changeAddress" action to "customer" with values
    """
        {
          "action": "changeAddress",
          "addressId": "addressId-1",
          "address": {
            "email": "john.doe@example.org",
            "firstName": "John",
            "lastName": "Doe"
          }
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeAddress",
          "addressId": "addressId-1",
          "address": {
            "email": "john.doe@example.org",
            "firstName": "John",
            "lastName": "Doe"
          }
        }
      ]
    }
    """
  Scenario: Remove a customer's address
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "removeAddress" action to "customer" with values
    """
        {
          "action": "removeAddress",
          "addressId": "addressId-1"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeAddress",
          "addressId": "addressId-1"
        }
      ]
    }
    """

  Scenario: Set customer's default shipping address
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setDefaultShippingAddress" action to "customer" with values
    """
        {
          "action": "setDefaultShippingAddress",
          "addressId": "addressId-1"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDefaultShippingAddress",
          "addressId": "addressId-1"
        }
      ]
    }
    """

  Scenario: Unset customer's default shipping address
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setDefaultShippingAddress" action to "customer" with values
    """
        {
          "action": "setDefaultShippingAddress"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDefaultShippingAddress"
        }
      ]
    }
    """

  Scenario: Set customer's default billing address
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setDefaultBillingAddress" action to "customer" with values
    """
        {
          "action": "setDefaultBillingAddress",
          "addressId": "addressId-1"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDefaultBillingAddress",
          "addressId": "addressId-1"
        }
      ]
    }
    """
  Scenario: Unset customer's default billing address
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setDefaultBillingAddress" action to "customer" with values
    """
        {
          "action": "setDefaultBillingAddress"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDefaultBillingAddress"
        }
      ]
    }
    """

  Scenario: Set customer group
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setCustomerGroup" action to "customer" with values
    """
        {
          "action": "setCustomerGroup",
          "customerGroup": {
            "typeId": "customer-group",
            "id": "myCustomerGroup"
          }
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
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
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setCustomerNumber" action to "customer" with values
    """
        {
          "action": "setCustomerNumber",
          "customerNumber": "customer-1"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setCustomerNumber",
          "customerNumber": "customer-1"
        }
      ]
    }
    """

  Scenario: Set external id
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setExternalId" action to "customer" with values
    """
        {
          "action": "setExternalId",
          "externalId": "customer-1"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setExternalId",
          "externalId": "customer-1"
        }
      ]
    }
    """

  Scenario: Set company name
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setCompanyName" action to "customer" with values
    """
        {
          "action": "setCompanyName",
          "companyName": "myCompany"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setCompanyName",
          "companyName": "myCompany"
        }
      ]
    }
    """

  Scenario: Set Date of Birth
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setDateOfBirth" action to "customer" with values
    """
        {
          "action": "setDateOfBirth",
          "dateOfBirth": "2014-10-15"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDateOfBirth",
          "dateOfBirth": "2014-10-15"
        }
      ]
    }
    """

  Scenario: Set Vat Id
    Given a "customer" is identified by "id" and version "1"
    And i want to update a "customer"
    And add the "setVatId" action to "customer" with values
    """
        {
          "action": "setVatId",
          "vatId": "myVatId"
        }
    """
    Then the path should be "customers/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setVatId",
          "vatId": "myVatId"
        }
      ]
    }
    """
