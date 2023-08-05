<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="index.css">
  <style>
    
    #Add-product {
      background-color: #04090f;
      color: white;
      /* margin-left: 330px; */
    }

    #begin {
      margin: 20px;
    }

    .table th {
      font-weight: bolder;
      font-size: large;
    }

    #view {
      background-color: #04090f;
      color: white;
      /* margin-left: 150px; */
      margin-bottom: 5px;
    }
  </style>
</head>

<body>


  <?php
  session_start();
  include('nav.html');


  if (!isset($_SESSION["cards"])) {
    $_SESSION["cards"] = array();

  }

  ?>

  <!-- form-section  -->
            
  <h1 style="text-align: center;margin-top: 10px">What matters most,<br> right on your wrist.</h1>
  
  <div class="container-fluid" id="img_background">
    <form action="# " method="POST" class="input">
      <label>Enter the product name:</label>
      <input type="text" name="product_name" class="inp" Required><br><br>

      <label>Enter the product description:</label>
      <input type="text" name="product_description" class="inpp" Required><br><br>

      <label>Enter the product image:</label>
      <input type="file" id="product_image" name="product_image" class="inp" multiple required><br><br>

      <label>Enter the product price:</label>
      <input type="text" name="product_price" class="inp" Required><br><br>
      <input type="submit" value="Add Product" id="Add-product">
    </form>
  </div>
  </form>
  </div>


  <?php

  if (!isset($_SESSION["cards"])) {
    $_SESSION["cards"] = array();
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $check = true;
    foreach ($_SESSION["cards"] as $value) {
      if ($_POST['product_name'] === $value[0] && $_POST['product_description'] === $value[1] && $_POST['product_image'] === $value[2] && $_POST['product_price'] === $value[3]) {
        $check = false;
        break; // No need to continue the loop once a match is found
      }
    }

    if ($check) {
      array_push(
        $_SESSION["cards"],
        array(
          htmlspecialchars($_POST['product_name']),
          htmlspecialchars($_POST['product_description']),
          $_POST['product_image'], // Assuming the image is already a valid URL or file path
          $_POST['product_price'],
        )
      );
    }
  }

  echo '<table class="table table-bordered" style="width: 60%;">';
  echo "<tr>";
  echo "<th>Name</th>";
  echo "<th>Description</th>";
  echo "<th>Image</th>";
  echo "<th>Price</th>";
  echo "</tr>";

  foreach ($_SESSION["cards"] as $value) {
    echo "<tr>";
    echo "<td>" . $value[0] . "</td>";
    echo "<td>" . $value[1] . "</td>";
    echo "<td>";
    echo '<img src="images/' . trim($value[2], 'uploads/') . '" alt="Card image cap" width="60px">';
    echo "</td>";
    echo "<td>" . $value[3] . "</td>";
    echo "</tr>";
  }
  echo "</table>";

  // session_unset();
// session_destroy();
  

  ?>

  <form action="products.php" method="post">
    <input id="view" type="submit" value="view products">
  </form>

  <!-- footer-section -->
  <footer class="footer">
    <div class="container-fluid footer_style">
      <div class="footer-logo">
        <img src="images/logo.png" alt="Logo">
      </div>
      <div class="footer-social">
        <p style="font-weight:bold" class="social">social media</p>
        <a href="#" class="social-icon"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
            <style>
              svg {
                fill: #139CF7
              }
            </style>
            <path
              d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
          </svg></a>
        <a href="#" class="social-icon"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
            <style>
              svg {
                fill: #139CF7
              }
            </style>
            <path
              d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
          </svg></a>
        <a href="#" class="social-icon"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
            <style>
              svg {
                fill: #E002E8
              }
            </style>
            <path
              d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
          </svg></i></a>
        <!-- Add more social media icons as needed -->
      </div>
      <div class="footer-links">
        <p style="font-weight:bold">Useful Links</p>
        <a href="#">Home</a>
        <a href="#">Shop</a>
        <a href="#">Services</a>
        <a href="#">Portfolio</a>
        <a href="#">Contact</a>
      </div>
      <div class="footer-contact">
        <p style="font-weight:bold">contact information</p>
        <p>Email: info@example.com</p>
        <p>Phone: +123456789</p>
        <p>Address: 123 Street, City, Country</p>
      </div>
    </div>
  </footer>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>