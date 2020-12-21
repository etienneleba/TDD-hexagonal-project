Feature: As a stylist I can create a look

  Background:
    Given some morphologies exist
      | name |
      | X    |
      | H    |
      | A    |
      | V    |
      | O    |
      | 8    |

    Given some heights exist
      | name    |
      | small   |
      | average |
      | tall    |

    Given some parts exist
      | name        |
      | top         |
      | bottom      |
      | shoes       |
      | accessories |

  Scenario Outline:
    When I create a look with the name name
    Then the look should be created
    And the look should have the name name
    And the look should have a mannequin for each combination of height and morphology
    And the mannequins should have a part for each existing parts
    Examples:
      | name                    |
      | look automne/hiver 2020 |
      | look Noël 2020          |