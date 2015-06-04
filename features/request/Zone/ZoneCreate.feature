Feature: I want to create a new zone
  Background:
    Given i have a zone location object as location
    And set the country to DE
    And set the state to Berlin
    Given i have a zone locationCollection object as locations
    And add the location object to locations collection
    Given i have a zone draft
    And the name is "myZone"
    And the location is locations object
    And set the description to "Zone 1"

  Scenario: create a zone
    When i want to create a "zone"
    Then the path should be "/zones"
    And the method should be "POST"
    And the request should be
    """
    {
      "name": "myZone",
      "description": "Zone 1",
      "locations": [
        {
          "country": "DE",
          "state": "Berlin"
        }
      ]
    }
    """
