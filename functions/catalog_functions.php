<?php


function getAllBooks($db) {  
  $query = 'SELECT * FROM books';
  $statement = $db->prepare($query);
  $statement->execute();
  $books = $statement->fetchAll(PDO::FETCH_ASSOC);
  $statement->closeCursor();
  return $books;
}
 
function getAvailCopies($db, $isbn) {
 $query = 'SELECT avail_copies
          FROM books            
          WHERE isbn = :isbn';
  $statement = $db->prepare($query);
  $statement->bindValue(':isbn', $isbn);
  $statement->execute();    
  $result = $statement->fetch();
  $statement->closeCursor();
  return $result['avail_copies'];
}

//this function returns the title only for the requested isbn. 
function getTitle($db, $isbn) {
    $query = "SELECT title FROM books where isbn = '$isbn'";
    $statement = $db->prepare($query);
    $statement->execute();
    $title = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
     $titleS = $title['title'];
    return$titleS;
}

//this function returns the author only for the requested isbn.
function getAuthor($db, $isbn) {
    $query = "SELECT author FROM books where isbn = '$isbn'";
    $statement = $db->prepare($query);
    $statement->execute();
    $author = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    $authorS = $author['author'];
    return $authorS;
}

function getBookHTML($db, $book) {
  
  $image_file = "img/books/".$book['isbn'].".jpg";
  
  $html_out = <<<EOD
    <figure>
      <img src="{$image_file}" alt="{$book['title']}">
      <figcaption><span class='book_title'>{$book['title']}</span><br />
      by {$book['author']}<br /> 
      isbn {$book['isbn']}<br /> 
      <span class='copies'>Copies available: {$book['avail_copies']}</span><br />
      <input type="checkbox" id={$book['isbn']} name="isbn[]" value={$book['isbn']}>
      <label for={$book['isbn']}>Borrow this book</label>
      </figcaption>
    </figure>
EOD;
            
    return $html_out;
 
 }
 


?>