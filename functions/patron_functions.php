<?php

function getAllPatrons($db) {  
  $query = 'SELECT * FROM patrons ORDER BY last_name';
  $statement = $db->prepare($query);
  $statement->execute();
  $patrons = $statement->fetchAll();
  $statement->closeCursor();
  return $patrons;
}

//this function returns all information from the patrons table for the patron with the given card_number
function getPatronInfo($db, $card_number){
  $query = "SELECT * From patrons Where card_number = '$card_number'";
  $statement = $db->prepare($query);
  $statement->execute();
  $patron = $statement->fetch(PDO::FETCH_ASSOC);
  $statement->closeCursor();
  return $patron;
  
}

//this function returns isbn, date_checked_out, title, author, and checkout_id
//for all books loaned to the patron with the given card_number
function getLoansByPatron($db, $card_number) {
  $query = "SELECT title,author,date_checked_out,checkout_id, books.isbn FROM loans INNER JOIN books ON loans.isbn = books.isbn WHERE card_number='$card_number'";
  $statement = $db->prepare($query);
  $statement->execute();
  $loan = $statement->fetchALL(PDO::FETCH_ASSOC);
  $statement->closeCursor();
  return $loan;
  
 }
 


?>