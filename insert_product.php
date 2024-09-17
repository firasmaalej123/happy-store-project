<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/insert_product.css">
    <title>Add Product</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
        }
        .container {
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 100%;
        }
        .left-column, .right-column {
            padding: 20px;
            box-sizing: border-box;
        }
        .left-column {
            width: 40%;
            overflow-y: auto;
        }
        .right-column {
            width: 60%;
            overflow-y: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        @media (min-width: 768px) {
            .container {
                flex-direction: row;
            }
            .left-column {
                width: 60%;
            }
            .right-column {
                width: 40%;
            }
        }
        @media (max-width: 767px) {
            table, th, td {
                display: block;
                width: 100%;
            }
            th, td {
                box-sizing: border-box;
                width: 100%;
                padding: 10px;
            }
            tr {
                margin-bottom: 10px;
                display: flex;
                flex-direction: column;
                border: 1px solid black;
            }
            tr td:first-child {
                border-top: none;
            }
            tr td:last-child {
                border-bottom: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="left-column">
            <?php
            // Database connection parameters
            include 'dbc.php';

            // Fetch product names and images
            $products_sql = "SELECT product_id, product_name, image, mime_type FROM products";
            $products_result = $conn->query($products_sql);

            // Handle removal of product
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_product_id'])) {
                $remove_product_id = $_POST['remove_product_id'];
                $delete_sql = "DELETE FROM products WHERE product_id = ?";
                $stmt = $conn->prepare($delete_sql);
                $stmt->bind_param("i", $remove_product_id);
                $stmt->execute();
                $stmt->close();
                // Reload the page to reflect changes
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
            ?>

            <h1>Products</h1>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Action</th>
                </tr>
                <?php while($row = $products_result->fetch_assoc()) { ?>
                <tr>
                    <td><img src="data:<?php echo $row['mime_type']; ?>;base64,<?php echo base64_encode($row['image']); ?>" alt="<?php echo $row['product_name']; ?>" class="product-image"></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="remove_product_id" value="<?php echo $row['product_id']; ?>">
                            <button type="submit" class="remove-button">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="right-column">
            <form action="insert_product.php" method="post" enctype="multipart/form-data">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" id="product_name" required><br>

                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea><br>

                <label for="price">Price:</label>
                <input type="text" name="price" id="price" required><br>

                <label for="older_price">Older Price:</label>
                <input type="text" name="older_price" id="older_price" required><br>

                <label for="stock">Stock:</label>
                <input type="text" name="stock" id="stock" ><br>
 
                
                <select name="category_name" id="category_name" required>
     <option value="" disabled selected>Select category</option>

                    
<option value="phones">phones</option>
<option value="electronics">electronics</option>
<option value="men clothes">men clothes</option>
<option value="women clothes">women clothes</option>


                    <!-- Add other countries as needed -->
                </select>

                <select name="sub_category_name" id="sub_category_name" required>
    <option value="" disabled selected>Select sub_category</option>
    <option value="smartphone">Smartphone</option>
    <option value="charger case">Charger Case</option>
    <option value="earphones headphones">Earphones Headphones</option>
    <option value="men shorts">Men Shorts</option>
    <option value="men shirts">Men Shirts</option>
    <option value="men shoes">Men Shoes</option>
    <option value="women shorts">Women Shorts</option>
    <option value="women shirts">Women Shirts</option>
    <option value="women shoes">Women Shoes</option>
    <option value="women dresses">Women Dresses</option>
    <option value="vape liquid">Vape Liquid</option>
    <option value="smartwatch">Smartwatch</option>
    <option value="speakers">Speakers</option>
</select>

                <label for="image">Image:</label>
                <input type="file" name="image" id="image" required><br>
                <label for="image1">Image1:</label>
                <input type="file" name="image1" id="image1" ><br>
                <label for="image2">Image2:</label>
                <input type="file" name="image2" id="image2" ><br>
                <label for="image3">Image3:</label>
                <input type="file" name="image3" id="image3" ><br>

                <input type="submit" name="submit" value="Add Product">
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $older_price = $_POST['older_price'];
        $stock = $_POST['stock'];
        $category_name = $_POST['category_name'];
        $sub_category_name = $_POST['sub_category_name'];
        $imgContent = file_get_contents($_FILES['image']['tmp_name']);
        $mime_type = $_FILES['image']['type'];

        if ($_FILES['image1']['size'] > 0) {
            $imgContent1 = file_get_contents($_FILES['image1']['tmp_name']);
            $mime_type1 = $_FILES['image1']['type'];
        } else {
            $imgContent1 = null;
            $mime_type1 = null;
        }
    
        // Handle image 2
        if ($_FILES['image2']['size'] > 0) {
            $imgContent2 = file_get_contents($_FILES['image2']['tmp_name']);
            $mime_type2 = $_FILES['image2']['type'];
        } else {
            $imgContent2 = null;
            $mime_type2 = null;
        }
    
        // Handle image 3
        if ($_FILES['image3']['size'] > 0) {
            $imgContent3 = file_get_contents($_FILES['image3']['tmp_name']);
            $mime_type3 = $_FILES['image3']['type'];
        } else {
            $imgContent3 = null;
            $mime_type3 = null;
        }
    


        // Function to fetch sub_category_id and insert if not exists
        function fetchSubCategoryId($conn, $sub_category_name, $category_name) {
            // Check if the category exists, insert if not
            $sql_category = "SELECT category_id FROM categories WHERE category_name = ?";
            $stmt_category = $conn->prepare($sql_category);
            $stmt_category->bind_param("s", $category_name);
            $stmt_category->execute();
            $result_category = $stmt_category->get_result();

            if ($result_category->num_rows > 0) {
                // Category exists, fetch category_id
                $row_category = $result_category->fetch_assoc();
                $category_id = $row_category['category_id'];
            } else {
                // Insert new category and fetch category_id
                $sql_insert_category = "INSERT INTO categories (category_name) VALUES (?)";
                $stmt_insert_category = $conn->prepare($sql_insert_category);
                $stmt_insert_category->bind_param("s", $category_name);
                $stmt_insert_category->execute();
                $category_id = $stmt_insert_category->insert_id;
                $stmt_insert_category->close();
            }
            $stmt_category->close();

            // Check if the sub_category exists, insert if not
            $sql_sub_category = "SELECT sub_category_id FROM sub_category WHERE sub_category_name = ?";
            $stmt_sub_category = $conn->prepare($sql_sub_category);
            $stmt_sub_category->bind_param("s", $sub_category_name);
            $stmt_sub_category->execute();
            $result_sub_category = $stmt_sub_category->get_result();

            if ($result_sub_category->num_rows > 0) {
                // Subcategory exists, fetch sub_category_id
                $row_sub_category = $result_sub_category->fetch_assoc();
                $sub_category_id = $row_sub_category['sub_category_id'];
            } else {
                // Insert new sub-category and fetch sub_category_id
                $sql_insert_sub_category = "INSERT INTO sub_category (sub_category_name, category_id) VALUES (?, ?)";
                $stmt_insert_sub_category = $conn->prepare($sql_insert_sub_category);
                $stmt_insert_sub_category->bind_param("si", $sub_category_name, $category_id);
                $stmt_insert_sub_category->execute();
                $sub_category_id = $stmt_insert_sub_category->insert_id;
                $stmt_insert_sub_category->close();
            }
            $stmt_sub_category->close();

            return $sub_category_id;
        }

        // Fetch or insert sub_category_id
        $sub_category_id = fetchSubCategoryId($conn, $sub_category_name, $category_name);

        // Prepare SQL statement with parameters
        $sql = "INSERT INTO products (product_name, description, price, older_price, stock, sub_category_id, image, mime_type, image1, mime_type1, image2, mime_type2, image3, mime_type3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssddisssssssss", $product_name, $description, $price, $older_price, $stock, $sub_category_id, $imgContent, $mime_type, $imgContent1, $mime_type1, $imgContent2, $mime_type2, $imgContent3, $mime_type3);

        if ($stmt->execute()) {
            echo "File uploaded successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
