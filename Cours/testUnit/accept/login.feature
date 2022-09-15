Feature: addIfNotExist
  In order to add
  As a user
  I need to provide a valid number

  Scenario: try Ajouter
    Given i am on page "src/index.php"
    When i have the number 99 as "Nombre"
    And i click on "Ajouter"
    Then i should see "Le nombre 99 a bien été ajouté"

  Scenario: try dejaLa
    Given i am on page "src/index.php"
    When i have the number 99 as "Nombre"
    And i click on "Ajouter"
    Then i should see "Le nombre 99 existe déjà"

  Scenario: try nbInvalide
    Given i am on page "src/index.php"
    When i have the number 22222222222222222222222 as "Nombre"
    And i click on "Ajouter"
    Then i should see "Veuillez entrer un nombre valide"

