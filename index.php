<?php 

  $pageTitle = "Library Catalog";
  $description = "Displays the available books for th elibrary";
  include('inc/header.php');
  include_once('functions/catalog_functions.php');
  include_once('functions/checkout_functions.php');
  include_once('functions/patron_functions.php');  
  require_once('inc/open_db.php');
  session_start();
   
  $msg = "";
  
  if (isset($_POST['card_number'])){
    $_SESSION['patron_card'] = $_POST['card_number'];
  }
  
  if (isset($_POST['view_loans'])){
    header('Location: loans.php'); 
  }
  
  if (isset($_POST['view_patron'])){
     if ($_POST['card_number'] == "none") {
         $msg = "Please select a patron.";      }
     else {
       header('Location: patron_info.php');     
     }    
  }
     
  //checking out book(s)
  if (isset($_POST['isbn']) && count($_POST['isbn']) > 0){  
      if ($_POST['card_number'] == "none") {
         $msg = "You must select a patron before checking out a book.";
      }
      else {
        foreach ($_POST['isbn'] as $isbn){  
          if (getAvailCopies($db, $isbn) > 0) {
            checkoutBook($db, $isbn, $_POST['card_number']);
            updateAvailCopies($db, $isbn, -1);
          }
          else {
            $title = getTitle($db, $isbn);
            $msg = $msg . "Sorry, there are no available copies of $title at this time.<br>";
          }
        }
      }      
    unset($_POST['isbn']);    
   } 
   else if (isset($_POST['borrow'])){
     $msg = "No books selected.";
   }
   
   $books = getAllBooks($db);
   $patrons = getAllPatrons($db); 


?>


<main> 
    
    <form action="" method="post">
      <section class="flex_buttons">        
        <select name="card_number">
          <option value="none">Select a patron</option>
          <?php          
            foreach($patrons as $patron) { 
          ?>
              <option value="<?php echo $patron['card_number'];?>"
              <?php
                //keep currently selected patron, if one
                if (isset($_SESSION['patron_card'])){
                  if ($_SESSION['patron_card'] == $patron['card_number']) {
                    echo "selected";
                  }
                }
               ?> >
              <?php echo $patron['first_name']." ".$patron['last_name'];?>      
              </option>      
            <?php
            } 
           ?>
        </select>
        <input type="submit" name="borrow" value="Checkout Selected Books">
        <input type="submit" name="view_patron" value="View Patron Info">
        <input type="submit" name="view_loans" value="View all loaned items">
      </section>
          
      <p id="message"><?php echo $msg; ?></p>

      <section class="flex_content">          
      <?php
        //display each book in the inventory
        foreach($books as $book) { 
          echo getBookHTML($db, $book);
        }                       
      ?>  
      </section>
   </form>
</main>

<?php include('inc/footer.php') ?>