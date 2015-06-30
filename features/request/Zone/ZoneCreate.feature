Feature: I want to create a new zone
  Background:
    Given i have a "zone" draft with values
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

  Scenario: create a zone
    When i want to create a "zone"
    Then the path should be "zones"
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
