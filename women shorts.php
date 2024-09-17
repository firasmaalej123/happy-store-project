<?php
session_start();

// Initialize $username variable
$username = "";
$var="women shorts";

// Check if user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is logged in, get the username
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $var ?></title>


  <link rel="shortcut icon" href="./assets/images/logo/mobileicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



  <link rel="stylesheet" href="./assets/css/test.css">

 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <style>
.product-card img {
  transition: transform 0.3s ease-in-out;
  cursor: pointer;
}

/* Default styles */
.product-card img.zoomed {
  transform: scale(1.5); /* Adjusted from 2 to 1.5 */
  z-index: 101;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(0.7); /* Corrected to match the scaling factor */
}

/* Media query for mobile view */


/* Media query for desktop view */
@media (min-width: 1024px) {
  .product-card img.zoomed {
    transform: scale(1.5); /* Adjusted from 2 to 1.5 */
  z-index: 101;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(0.3); /* Corrected to match the scaling factor */
  }
}


.blur-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(0.05px);
  z-index: 100;
  display: none;
}

.blur-overlay.active {
  display: block;
}
.product-card {
    position: relative;
    overflow: hidden;
    width: 100%;
    max-width: 300px;
    margin: 10px;
}

.carousel {
    display: flex;
    flex-direction: row;
    width: 100%;
    overflow: hidden;
    position: relative;
}

.carousel-item {
    min-width: 100%;
    transition: transform 0.5s ease-in-out;
}

.carousel-item img {
    width: 100%;
    height: auto;
}

.carousel-item:not(.active) {
    display: none;
}

.carousel-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
}

.carousel-nav button {
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    padding: 5px 10px;
    cursor: pointer;
}


    </style>

</head>

<body>



  <div class="overlay" data-overlay></div>

  <!--
    - MODAL
  -->

  




  <!--
    - NOTIFICATION TOAST
  -->

  





  <!--
    - HEADER
  -->

  <header>

    <div class="header-top">

      <div class="container">

        <ul class="header-social-container">

          <li>
            <a href="https://www.facebook.com/profile.php?id=61561993384117&mibextid=ZbWKwL" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          

          <li>
            <a href="https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.instagram.com%2Fhappystore195%3Figsh%3DMTNnMjQ5cXNraWxnbQ%253D%253D%26fbclid%3DIwZXh0bgNhZW0CMTAAAR3yYSNFFHbIABzQvgmzq3b_pd21PQSLAzejEpG0FGZZEAesgklifSNFBlg_aem_4cEsnB4i5mHszOMUb4dK1A&h=AT0hQW0DJXfGrglCHrK-tVQw95qnj4x3LNKeKmZ5LlIpEkSghCMO_1DvdBci6hEolqNGEz20jXWyybh4UXZMKWM_kqUBYabZmUKVBWTfV8Lloq7eAEFfLIDYaVdmA0UJDeESgw" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>


        </ul>

       

        <div class="header-top-actions">

          <select name="currency">

            <option value="dt">TND </option>
            

          </select>

          <select name="language">

            <option value="en-US">English</option>
           

          </select>

        </div>

      </div>

    </div>

    <div class="header-main">

      <div class="container">

        <a href="index.php" class="header-logo">
          <img src="./assets/images/logo/logo.svg" alt="happy_store's logo" width="120" height="36">
        </a>

        <div class="header-search-container">
    <input type="search" name="search" class="search-field" placeholder="Enter your product name...">
    <button class="search-btn">
      <ion-icon name="search-outline"></ion-icon>
    </button>
  </div>
  <div class="search-results" style="display: none;"></div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const searchField = document.querySelector('.search-field');
      const searchResults = document.querySelector('.search-results');

      searchField.addEventListener('input', function() {
        const query = this.value;

        if (query.length > 0) { // Start searching after 3 characters
          fetch(`search.php?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
              searchResults.innerHTML = '';
              if (data.length > 0) {
                data.forEach(item => {
                  const div = document.createElement('div');
                  div.classList.add('search-result-item');
                  div.textContent = item.sub_category_name; // Ensure this matches your PHP output
                  div.addEventListener('click', () => {
                    const subCategoryName = item.sub_category_name; // Get the sub_category_name from the clicked item
                   window.location.href = `${subCategoryName}.php`;
                  });
                  searchResults.appendChild(div);
                });
                searchResults.style.display = 'block';
              } else {
                searchResults.style.display = 'none';
              }
            })
            .catch(error => {
              console.error('Error fetching search results:', error);
            });
        } else {
          searchResults.style.display = 'none';
        }
      });
    });
  </script>

        <div class="header-user-actions">

        <?php


// Check if user is logged in
$logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Function to determine icon color based on login status
function getIconColor($logged_in) {
    return $logged_in ? '#ff99cc' : '#ff6666'; // Pink for logged in, red for not logged in
}
?>



<?php
// Include this PHP block where you want to use the button
$iconColor = getIconColor($logged_in);
?>

<a href="profile.php" class="action-btn">
    <ion-icon name="person-outline" style="color: <?php echo $iconColor; ?>"></ion-icon>
</a>

          

          <a href="cart.php" class="action-btn">
            <ion-icon name="bag-handle-outline" style="color: <?php echo $iconColor; ?>"></ion-icon>
            <?php
require 'dbc.php'; // Include the database connection

// Check if user is logged in
$logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Initialize the product count variable
$product_count = 0;

if ($logged_in) {
    // Query to count products in the shopping cart for the logged-in user
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT COUNT(*) AS product_count FROM shopping_cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_count = $row['product_count'];
    }

    $stmt->close();
}

$conn->close();
?>
            <span class="count"><?php echo $product_count; ?></span>
</a>

        </div>

      </div>

    </div>

    <nav class="desktop-navigation-menu">

      <div class="container">

        <ul class="desktop-menu-category-list">

          <li class="menu-category">
            <a href="index.php" class="menu-title">Home</a>
          </li>

          <li class="menu-category">
            <a href="#" class="menu-title">Categories</a>

            <div class="dropdown-panel">

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="phones.php">Phones</a>
                </li>

                <li class="panel-list-item">
                  <a href="generate.php?param=smartphone">SmartPhones</a>
                </li>
                <li class="panel-list-item">
                  <a href="generate.php?param=charger case">Phone Chargers & Cases</a>
                </li>

                

                <li class="panel-list-item">
                  <a href="generate.php?param=earphones headphones">Earphones & Headphones</a>
                </li>
                <li class="panel-list-item">
                  <a href="phones.php">And more...</a>
                </li>
                

                <li class="panel-list-item">
                  <a href="#">
                    <img src="./assets/images/electronics-banner-1.jpg" alt="headphone collection" width="250"
                      height="119">
                  </a>
                </li>

              </ul>

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="men_clothes.php">Men's</a>
                </li>

                <li class="panel-list-item">
                  <a href="generate.php?param=men shorts">men's Shorts</a>
                </li>

                <li class="panel-list-item">
                  <a href="generate.php?param=men shirts">men's Tshirts</a>
                </li>

                <li class="panel-list-item">
                  <a href="generate.php?param=men shoes">men's Shoes</a>
                </li>
                <li class="panel-list-item">
                  <a href="men_clothes.php">And more...</a>
                </li>

               

                <li class="panel-list-item">
                  <a href="#">
                    <img src="./assets/images/mens-banner.jpg" alt="men's fashion" width="250" height="119">
                  </a>
                </li>

              </ul>

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="women_clothes.php">Women's</a>
                </li>

                <li class="panel-list-item">
                  <a href="generate.php?param=women shorts">women's Shorts</a>
                </li>

                <li class="panel-list-item">
                  <a href="generate.php?param=women shirts">women's Tshirts</a>
                </li>

                <li class="panel-list-item">
                  <a href="generate.php?param=women shoes">women's Shoes</a>
                </li>
                <li class="panel-list-item">
                  <a href="women_clothes.php">And more...</a>
                </li>

                

                <li class="panel-list-item">
                  <a href="#">
                    <img src="./assets/images/womens-banner.jpg" alt="women's fashion" width="250" height="119">
                  </a>
                </li>

              </ul>
              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="electronics.php">Electronics</a>
                </li>

                <li class="panel-list-item">
                  <a href="generate.php?param=vape liquid">Vapes & Liquid</a>
                </li>
                <li class="panel-list-item">
                  <a href="generate.php?param=smartwatch">SmartWatch</a>
                </li>

                
                <li class="panel-list-item">
                  <a href="generate.php?param=speakers">Speakers</a>
                </li>
                <li class="panel-list-item">
                  <a href="electronics.php">And more...</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">
                    <img src="./assets/images/electronics-banner-2.jpg" alt="headphone collection" width="250"
                      height="119">
                  </a>
                </li>

              </ul>

              

            </div>
          </li>

          <li class="menu-category">
            <a href="men_clothes.php" class="menu-title">Men's</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="generate.php?param=men shirts">Shirts</a>
              </li>

              <li class="dropdown-item">
                <a href="generate.php?param=men shorts">Shorts</a>
              </li>

              <li class="dropdown-item">
                <a href="generate.php?param=men shoes">Shoes</a>
              </li>
            </ul>
          </li>

          <li class="menu-category">
            <a href="women_clothes.php" class="menu-title">Women's</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="generate.php?param=women shirts">Shirts</a>
              </li>

              <li class="dropdown-item">
                <a href="generate.php?param=women shorts">Shorts</a>
              </li>

              <li class="dropdown-item">
                <a href="generate.php?param=women shoes">Shoes</a>
              </li>

            </ul>
          </li>

          <li class="menu-category">
            <a href="phones.php" class="menu-title">Phones</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="generate.php?param=smartphone">SmartPhones</a>
              </li>

              <li class="dropdown-item">
                <a href="generate.php?param=earphones headphones">Earphones & Headphones</a>
              </li>

              <li class="dropdown-item">
                <a href="generate.php?param=charger case">Phone Chargers and Cases</a>
              </li>

             
              

            </ul>
          </li>

          <li class="menu-category">
            <a href="electronics.php" class="menu-title">Electronics</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="generate.php?param=smartwatch">SmartWatch</a>
              </li>

              

              

              <li class="dropdown-item">
                <a href="generate.php?param=speakers">Speakers</a>
              </li>
              <li class="dropdown-item">
                <a href="generate.php?param=vape liquid">Vapes & Liquid</a>
              </li>

            </ul>
          </li>

          <li class="menu-category">
            <a href="#" class="menu-title">Coming Soon !</a>
            

            

           </li>


          <li class="menu-category">
            <a href="about_us.php" class="menu-title">About Us</a>
          </li>

         
        </ul>

      </div>

    </nav>

    <div class="mobile-bottom-navigation">

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>

      <a href="cart.php" class="action-btn">
        <ion-icon name="bag-handle-outline"></ion-icon>

        <span class="count"><?php echo $product_count; ?></span>
</a>

      <a href="index.php" class="action-btn">
        <ion-icon name="home-outline"></ion-icon>
      </a>

      <a href="profile.php" class="action-btn">
      <ion-icon name="person-outline"></ion-icon>

        
      </a>

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>

    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

      <div class="menu-top">
        <h2 class="menu-title">Menu</h2>

        <button class="menu-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <ul class="mobile-menu-category-list">

        <li class="menu-category">
          <a href="index.php" class="menu-title">Home</a>
        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Men's</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="generate.php?param=men shirts" class="submenu-title">Men's Shirts & Jackets</a>
            </li>

            <li class="submenu-category">
              <a href="generate.php?param=men shorts" class="submenu-title">Men's Shorts & Jeans</a>
            </li>

            <li class="submenu-category">
              <a href="generate.php?param=men shoes" class="submenu-title">Men's Shoes</a>
            </li>

            

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Women's</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="generate.php?param=women shirts" class="submenu-title">Women's Shirts</a>
            </li>
            <li class="submenu-category">
              <a href="generate.php?param=women dresses" class="submenu-title">Women's Dresses</a>
            </li>

            <li class="submenu-category">
              <a href="generate.php?param=women shorts" class="submenu-title">Women's Shorts & Jeans</a>
            </li>

            <li class="submenu-category">
              <a href="generate.php?param=women shoes" class="submenu-title">Women's Shoes</a>
            </li>

           

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Phones</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="generate.php?param=smartphone" class="submenu-title">SmartPhones</a>
            </li>

            <li class="submenu-category">
              <a href="generate.php?param=earphones headphones" class="submenu-title">EarPhones & Headphones</a>
            </li>

            <li class="submenu-category">
              <a href="generate.php?param=charger case" class="submenu-title">Phone Chargers & Cases</a>
            </li>

           
        

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Electronics</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="generate.php?param=smartwatch" class="submenu-title">SmartWatch</a>
            </li>

            

            

            <li class="submenu-category">
              <a href="generate.php?param=speakers" class="submenu-title">Speakers</a>
            </li>
            <li class="submenu-category">
              <a href="generate.php?param=vape liquid" class="submenu-title">Vapes & Liquid</a>
            </li>

          </ul>

        </li>

        


      </ul>

      <div class="menu-bottom">

        <ul class="menu-category-list">

          <li class="menu-category">
          <?php

// Check if user is logged in
$logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Function to determine text color based on login status
function getTextColor($logged_in) {
    return $logged_in ? '#ff99cc' : '#ff6666'; // Pink for logged in, red for not logged in
}
?>

<?php
// Include this PHP block where you want to use the text color
$textColor = getTextColor($logged_in);
?>



            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Language</p>

              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>

              <li class="submenu-category">
                <a href="#" class="submenu-title">English</a>
              </li>

             

            </ul>

          </li>

          <li class="menu-category">
            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Currency</p>
              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>
              <li class="submenu-category">
                <a href="#" class="submenu-title">TND</a>
              </li>

             
            </ul>
          </li>

        </ul>

        <ul class="menu-social-container">

          <li>
            <a href="https://www.facebook.com/profile.php?id=61561993384117&mibextid=ZbWKwL" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          
          <li>
            <a href="https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.instagram.com%2Fhappystore195%3Figsh%3DMTNnMjQ5cXNraWxnbQ%253D%253D%26fbclid%3DIwZXh0bgNhZW0CMTAAAR3yYSNFFHbIABzQvgmzq3b_pd21PQSLAzejEpG0FGZZEAesgklifSNFBlg_aem_4cEsnB4i5mHszOMUb4dK1A&h=AT0hQW0DJXfGrglCHrK-tVQw95qnj4x3LNKeKmZ5LlIpEkSghCMO_1DvdBci6hEolqNGEz20jXWyybh4UXZMKWM_kqUBYabZmUKVBWTfV8Lloq7eAEFfLIDYaVdmA0UJDeESgw" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          

        </ul>

      </div>

    </nav>

  </header>
  <main>
  <div class="product-grid">
    <?php
    include 'dbc.php';

    $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
    $newSortOrder = $sortOrder === 'asc' ? 'desc' : 'asc';
    error_log("Value of var: " . $var);

    $subCatQuery = "SELECT sub_category_id 
                    FROM sub_category 
                    WHERE sub_category_name = '" . mysqli_real_escape_string($conn, $var) . "'";
    $subCatResult = mysqli_query($conn, $subCatQuery);

    if (!$subCatResult) {
        error_log("Error executing subCatQuery: " . mysqli_error($conn));
    } else {
        error_log("subCatQuery executed successfully");
    }

    if ($subCatResult && mysqli_num_rows($subCatResult) > 0) {
        $query = "SELECT product_id, product_name, description, price, image, mime_type, image1, mime_type1, image2, mime_type2, image3, mime_type3 
                  FROM products 
                  WHERE sub_category_id = (SELECT sub_category_id 
                                           FROM sub_category 
                                           WHERE sub_category_name = '" . mysqli_real_escape_string($conn, $var) . "') 
                  ORDER BY price $sortOrder";
    } else {
        echo 'Sub-category not found, displaying all products.';
        echo $var;
        error_log("Sub-category not found, displaying all products.");
        $query = "SELECT product_id, product_name, description, price, image, mime_type, image1, mime_type1, image2, mime_type2, image3, mime_type3 
                  FROM products 
                  ORDER BY price $sortOrder";
    }

    $result = mysqli_query($conn, $query);

    if (!$result) {
        error_log("Error executing product query: " . mysqli_error($conn));
    } else {
        error_log("Product query executed successfully");
    }

    if ($result) {
      echo '<form method="GET" action="" style="text-align: center;">';
      echo '<button type="submit" name="sort" value="'.$newSortOrder.'" class="sort-button">';
      echo $sortOrder === 'asc' ? 'Price <i class="fas fa-arrow-up"></i>' : 'Price <i class="fas fa-arrow-down"></i>';
      echo '</button>';
      echo '</form>';
      
      echo '<div class="product-grid">';
        
        while ($row = mysqli_fetch_assoc($result)) {
            $productId = htmlspecialchars($row['product_id']);
            $productName = htmlspecialchars($row['product_name']);
            $description = htmlspecialchars($row['description']);
            $price = htmlspecialchars($row['price']);

            // Prepare images
            $images = [];
            for ($i = 0; $i <= 3; $i++) {
                $imgCol = 'image' . ($i === 0 ? '' : $i);
                $mimeTypeCol = 'mime_type' . ($i === 0 ? '' : $i);
                if (!empty($row[$imgCol])) {
                    $images[] = 'data:' . $row[$mimeTypeCol] . ';base64,' . base64_encode($row[$imgCol]);
                }
            }

            echo '<div class="product-card">';
            echo '<div class="carousel">';
            foreach ($images as $index => $img) {
                echo '<div class="carousel-item'. ($index === 0 ? ' active' : '') .'">';
                echo '<img src="'.$img.'" alt="'.$productName.'">';
                echo '</div>';
            }
            echo '</div>';
            echo '<h2>'.$productName.'</h2>';
            echo '<p class="description">'.$description.'</p>';
            echo '<p class="price">'.$price.' TND </p>';
            echo '<form action="addtocart.php" method="POST">';
            echo '<input type="hidden" name="product_id" value="'.$productId.'">';
            echo '<button type="submit" class="add-to-cart">Add to Cart</button>';
            echo '</form>';
            echo '</div>';
        }

        echo '</div>'; 
    } else {
        echo "Error fetching products: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const carousels = document.querySelectorAll('.carousel');

    carousels.forEach(carousel => {
        const items = carousel.querySelectorAll('.carousel-item');
        let currentIndex = 0;

        const showItem = index => {
            items.forEach((item, i) => {
                item.classList.toggle('active', i === index);
            });
        };

        const nextItem = () => {
            currentIndex = (currentIndex + 1) % items.length;
            showItem(currentIndex);
        };

        const prevItem = () => {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            showItem(currentIndex);
        };

        const nav = document.createElement('div');
        nav.classList.add('carousel-nav');
        nav.innerHTML = `
            <button class="prev">&lt;</button>
            <button class="next">&gt;</button>
        `;

        carousel.appendChild(nav);

        nav.querySelector('.prev').addEventListener('click', prevItem);
        nav.querySelector('.next').addEventListener('click', nextItem);
    });
});

</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.product-card img');
    const blurOverlay = document.createElement('div');
    blurOverlay.className = 'blur-overlay';
    document.body.appendChild(blurOverlay);

    images.forEach(img => {
      img.addEventListener('click', function(event) {
        this.classList.toggle('zoomed');
        blurOverlay.classList.toggle('active');
        event.stopPropagation(); // Prevent the click event from bubbling up to the document
      });
    });

    document.addEventListener('click', function() {
      const zoomedImg = document.querySelector('.product-card img.zoomed');
      if (zoomedImg) {
        zoomedImg.classList.remove('zoomed');
        blurOverlay.classList.remove('active');
      }
    });

    blurOverlay.addEventListener('click', function() {
      const zoomedImg = document.querySelector('.product-card img.zoomed');
      if (zoomedImg) {
        zoomedImg.classList.remove('zoomed');
        blurOverlay.classList.remove('active');
      }
    });
  });
</script>



<div class="product-container">
      <div class="container">

        <!--
          - SIDEBAR
        -->

        <div class="sidebar  has-scrollbar" data-mobile-menu>

          <div class="sidebar-category">

            <div class="sidebar-top">
              <h2 class="sidebar-title">Category</h2>

              <button class="sidebar-close-btn" data-mobile-menu-close-btn>
                <ion-icon name="close-outline"></ion-icon>
              </button>
            </div>

            <ul class="sidebar-menu-category-list">

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/men_clothes.svg" alt="clothes" width="20" height="20"
                      class="menu-title-img">

                    <p class="menu-title">Men's Clothes</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=men shirts" class="sidebar-submenu-title">
                      <p class="product-name">Shirt & Jackets</p>
                      <data value="300" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'men shirts')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=men shorts" class="sidebar-submenu-title">
                      <p class="product-name">shorts & jeans</p>
                      <data value="60" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'men shorts')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

              

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=men shoes" class="sidebar-submenu-title">
                      <p class="product-name">shoes</p>
                      <data value="87" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'men shoes')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

                </ul>

              </li>

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/dress.svg" alt="footwear" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">women's clothes</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=women shirts" class="sidebar-submenu-title">
                      <p class="product-name">Shirts</p>
                      <data value="45" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'women shirts')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=women shorts" class="sidebar-submenu-title">
                      <p class="product-name">Shorts and Jeans</p>
                      <data value="75" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'women shorts')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=women dresses" class="sidebar-submenu-title">
                      <p class="product-name">Dresses</p>
                      <data value="35" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'women dresses')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=women shoes" class="sidebar-submenu-title">
                      <p class="product-name">Shoes</p>
                      <data value="26" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'women shoes')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?> </data>
                    </a>
                  </li>

                </ul>

              </li>

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/watch.svg" alt="clothes" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Electronics</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=vape liquid" class="sidebar-submenu-title">
                      <p class="product-name">Vapes & Liquid</p>
                      <data value="46" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'vape liquid')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

                  

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=smartwatch" class="sidebar-submenu-title">
                      <p class="product-name">SmartWatch</p>
                      <data value="61" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'smartwatch')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>
                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=speakers" class="sidebar-submenu-title">
                      <p class="product-name">Speakers</p>
                      <data value="61" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'speakers')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

                </ul>

              </li>

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/mobile.svg" alt="perfume" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Phones</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=smartphone" class="sidebar-submenu-title">
                      <p class="product-name">SmartPhones</p>
                      <data value="12" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'smartphone')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=earphones headphones" class="sidebar-submenu-title">
                      <p class="product-name">Earphones & Headphones</p>
                      <data value="60" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'earphones headphones')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="generate.php?param=charger case" class="sidebar-submenu-title">
                      <p class="product-name">Chargers and Cases</p>
                      <data value="50" class="stock" title="Available Stock"><?php  include 'dbc.php';
                      $query = "SELECT COUNT(*) AS count FROM products WHERE sub_category_id=( SELECT sub_category_id FROM sub_category WHERE sub_category_name LIKE 'charger case')";
                      $result = $conn->query($query);
                      
                      if ($result) {
                          $row = $result->fetch_assoc();
                          echo $row['count'];
                      } else {
                          echo "Error: " . $conn->error;
                      }
                      
                      $conn->close();
                        ?></data>
                    </a>
                  </li>

               

                </ul>

              </li>

              

              

            </ul>

          </div>

      
          
          </div>

        </div>

      </div>

    </div>

  </main>





  <!--
    - FOOTER
  -->

  <footer>

    <div class="footer-category">

      <div class="container">

        <h2 class="footer-category-title">Brand directory</h2>

        <div class="footer-category-box">

          <h3 class="category-box-title">Fashion :</h3>

          <a href="generate.php?param=women shirts" class="footer-category-link">Women T-shirt</a>
          <a href="generate.php?param=men shirts" class="footer-category-link">Men T-shirt</a>
          <a href="generate.php?param=women shorts" class="footer-category-link">Women shorts and Jeans</a>
          <a href="generate.php?param=men shorts" class="footer-category-link">Men Shorts and Jeans</a>
          <a href="generate.php?param=women shoes" class="footer-category-link">Women Shoes</a>
          <a href="generate.php?param=men shoes" class="footer-category-link">Men Shoes</a>
          <a href="generate.php?param=women dresses" class="footer-category-link">Women Dresses</a>

          

        </div>

        <div class="footer-category-box">
          <h3 class="category-box-title">Phones :</h3>
        
          <a href="generate.php?param=smartphone" class="footer-category-link">Smartphone</a>
          <a href="generate.php?param=charger case" class="footer-category-link">Chargers & Cases</a>
          <a href="generate.php?param=earphones headphones" class="footer-category-link">Earphones & Headphones</a>
          
          
        </div>

        <div class="footer-category-box">
          <h3 class="category-box-title">Electronics :</h3>
        
          <a href="generate.php?param=vape liquid" class="footer-category-link">Vape & Liquid</a>
          <a href="generate.php?param=smartwatch" class="footer-category-link">SmartWatch</a>
          <a href="generate.php?param=speakers" class="footer-category-link">Speakers</a>
        </div>

        

      </div>

    </div>

    <div class="footer-nav">

<div class="container">

  <ul class="footer-nav-list">
  
    <li class="footer-nav-item">
      <h2 class="nav-title">Our Company</h2>
    </li>
  
    <li class="footer-nav-item">
      <a href="delivery.php" class="footer-nav-link">Delivery</a>
    </li>
  
    
  
    
  
    <li class="footer-nav-item">
      <a href="about_us.php" class="footer-nav-link">About us</a>
    </li>
  
    
  
  </ul>
  

  

  

  

    

      
    </li>

  </ul>

</div>

</div>

    

  </footer>






  <!--
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



</body>

</html>

