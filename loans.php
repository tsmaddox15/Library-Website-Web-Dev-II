<?php
  
  $pageTitle = "Checkout";
  $description = "Displays all books on loan from the library";
  include('inc/header.php');
  include_once('functions/catalog_functions.php');
  include_once('functions/checkout_functions.php');
  require_once('inc/open_db.php');
  
?>

 
  <main> 
    
    <!-- your html here -->  
    <?php
      $allLoans = allLoans($db);
      
      /* Test for getAuthor and getTitle if you want to use it
      $aTest = getAuthor($db, "0061348112");
      $tTest = getTitle($db, "0061348112");
      echo $tTest;
      echo $aTest;
     */
      
    if (empty($allLoans)){
          echo "<p id='no_loan_msg'>No books out on loan.</p>";
        }
        else{
      echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Title</th><th>Author</th><th>Patron Name</th><th>Date Checked Out</th>";
            echo "</tr>"; 
            echo "</thead>";
            echo "<tbody>";
      foreach ($allLoans as $loan) { 
              $isbn = $loan['isbn'];
              $title = $loan['title'];
              $author = $loan['author'];
              $checkout_date = $loan['date_checked_out'];
              $checkout_id = $loan['checkout_id'];
              $name = $loan['first_name'] . " ".$loan['last_name'];
              echo "<tr>";
              echo "<td>$title</td><td>$author</td><td>$name</td><td>$checkout_date</td>";
              ?>
             
              </tr>
            <?php
            }
            echo "</tbody>";     
            echo "</table>";
            }
    ?>
              
    <form action="index.php" method="post">
      <input type="submit" name="catalog" value="Return to Catalog">
    </form>
  </main>

<?php
   include('inc/footer.php'); 
   
?>

