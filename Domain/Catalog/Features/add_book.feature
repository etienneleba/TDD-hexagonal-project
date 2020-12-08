Feature: As a Bookseller I can add a book to the catalog
  Background:
    Given a catalog

  Scenario: add a book
    When I add the book "1984" from "George Orwell" with a price of 10 € and a quantity of 3
    Then The book should be in the catalog


