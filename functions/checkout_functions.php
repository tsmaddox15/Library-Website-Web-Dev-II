<?php

function checkoutBook($db, $isbn, $card_number) {
    $query = 'INSERT INTO loans (isbn, card_number, date_checked_out) VALUES(:isbn, :card_number, NOW())';
    $statement = $db->prepare($query);
    $statement->bindValue(':isbn', $isbn);
    $statement->bindValue(':card_number', $card_number);
    $statement->execute();
    $statement->closeCursor();
}

//this function deletes the row from the loans table with the given checkout_id
function returnBook($db, $checkout_id) {
    $query = "DELETE FROM loans WHERE checkout_id = '$checkout_id'";
    $statement = $db->prepare($query);
    $statement->execute();
    $returned = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $returned;
}

//this function updates the books table by changing the quantity for the book with the given isbn.
//note that the parameter, $qty_increase, may be a positive or negative number
function updateAvailCopies($db, $isbn, $qty_increase) {
    $query = "UPDATE books SET avail_copies = avail_copies + '$qty_increase' WHERE isbn = '$isbn'";
    $statement = $db->prepare($query);
    $statement->execute();
    $returned = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $returned;
}

function allLoans($db) {
    $query = "SELECT title,author,first_name, last_name, date_checked_out,checkout_id, books.isbn FROM loans INNER JOIN books on loans.isbn = books.isbn INNER JOIN patrons on loans.card_number = patrons.card_number  ";
    $statement = $db->prepare($query);
    $statement->execute();
    $loans = $statement->fetchALL(PDO::FETCH_ASSOC);
    $statement->closeCursor();
//print_r($loans);
    return $loans;
}

?>