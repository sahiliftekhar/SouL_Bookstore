<?php
  session_start();
  $count = 0;
  // connect to database
  
  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4LatestBook($conn);
?>
      <!-- Example row of columns -->
      <p class="p-3 bg-dark text-white text-center"></p>
      <center><p class="lead text-center"> <h1> Latest Books </h1></p><br></center>
      <div class="row">
        <?php foreach($row as $book) { ?>
      	<div class="col-md-3">
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
           <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          </a>
      	</div>
        <?php } ?>
  
    </div>
  
<?php
  $count = 0; 
    // connect database
  require_once "./functions/database_functions.php";
  $conn = db_connect();

  $query = "SELECT book_isbn, book_image FROM books";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $title = "Full Catalogs of Books";
  require_once "./template/header.php";
?>
  <center><p class="lead text-center"> <h1> Our Gallery </h1></p><br></center>
    <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      <div class="container-fluid">
        <div class="row">
          <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
            <div class="col-md-3">
              <a href="book.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
                <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $query_row['book_image']; ?>">
              </a>
            </div>
          <?php
            $count++;
            if($count >= 4){
                $count = 0;
                break;
              }
            } ?> 
        </div>
      </div>
<?php
      }
  if(isset($conn)) { mysqli_close($conn); }
  require_once "./template/footer.php";
?>