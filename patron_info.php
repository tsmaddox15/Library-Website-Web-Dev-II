<?php

  $pageTitle = "Patron Info";
  $description = "Displays info for the current patron";
  include_once('inc/header.php');
  include_once('functions/patron_functions.php');
  include_once('functions/checkout_functions.php');
  require_once('inc/open_db.php');
  
  session_start();
  
  if (isset($_POST['return'])) {
    returnBook($db, $_POST['checkout_id']);
    updateAvailCopies($db, $_POST['isbn'], 1);
    unset($_POST['return']);
  }
?>  

<main id='patron_info'>

    <?php
      if (isset($_SESSION['patron_card'])) {
        $info = getPatronInfo($db, $_SESSION['patron_card']);        
        $loans = getLoansByPatron($db, $_SESSION['patron_card']);    
    
        echo "<p>Patron name:" . $info['first_name'] . " " . $info['last_name'] . "</p>";
        echo "<p>Email:" . $info['email'] . "</p>";
        echo "<p>Library card number: " . $info['card_number'] . "</p>";
   
        //display outstanding book loans
        if (empty($loans)){
          echo "<p id='no_loan_msg'>You do not have any outstanding book loans.</p>";
        }
        else {
           //begin table
           echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Title</th><th>Author</th><th>Date Checked Out</th><th></th>";
            echo "</tr>"; 
            echo "</thead>";
            echo "<tbody>";

            foreach ($loans as $book) { 
              $isbn = $book['isbn'];
              $title = $book['title'];
              $author = $book['author'];
              $checkout_date = $book['date_checked_out'];
              $checkout_id = $book['checkout_id'];
              echo "<tr>";
              echo "<td>$title</td><td>$author</td><td>$checkout_date</td>";
              ?>
              <td>             
                <form method="post">
                  <input type="hidden" name="checkout_id" value="<?php echo $checkout_id;?>">
                  <input type="hidden" name="isbn" value="<?php echo $isbn;?>">
                  <input type="submit" name="return" value="Return Book"></form>
              </td>
              </tr>
            <?php
            }
            echo "</tbody>";     
            echo "</table>";
        }
      }
      else {
        echo "You must enter a patron number to view this information.";
      }    
    ?>
    
  <form action="index.php" method="post">
    <input type="submit" name="catalog" value="Return to Catalog">
  </form>
  
</main>
      
<?php
   include('inc/footer.php'); 
?>
