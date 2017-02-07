<?php 
include_once("database.php");

class Product {

  private $bdd;
  private $flag_name;
  private $flag_price;
  private $flag_category;

  public function __construct()
  {
    $this->bdd = new Database();
    $this->bdd = $this->bdd->connect();
  }

  public function addProduct($name, $price, $category)
  {
    $sql = "INSERT INTO products (name, price, category_id) VALUES (:name, :price, :category_id)";

    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':name', $name, PDO::PARAM_STR);
    $sth->bindParam(':price', $price, PDO::PARAM_STR);
    $sth->bindParam(':category_id', $category, PDO::PARAM_STR);
    $sth->execute();
  }

  public function editProduct($productToEdit, $productnameToSet, $priceToSet, $categoryToSet)
  {
    $sql = "UPDATE products SET name = :productnameToSet, price = :priceToSet, category_id = :categoryToSet WHERE name = :productToEdit";
    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':productnameToSet', $productnameToSet, PDO::PARAM_STR);
    $sth->bindParam(':priceToSet', $priceToSet, PDO::PARAM_STR);
    $sth->bindParam(':categoryToSet', $categoryToSet, PDO::PARAM_STR);
    $sth->bindParam(':productToEdit', $productToEdit, PDO::PARAM_STR);
    $sth->execute();
  }

  public function deleteProduct($productToDelete)
  {
    $sql = "DELETE FROM products WHERE name = :productToDelete";
    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':productToDelete', $productToDelete, PDO::PARAM_STR);
    $sth->execute();
  }

  public function displayProduct($nameToDisplay)
  {
    $sql = "SELECT name, price, category_id FROM products WHERE name = :nameToDisplay";
    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':nameToDisplay', $nameToDisplay, PDO::PARAM_STR);
    $sth->execute();

    return ($sth);
  }

  public function selectAllProducts()
  {
    $sql = "SELECT name FROM products ORDER BY name";
    $sth = $this->bdd->prepare($sql);
    $sth->execute();

    return ($sth);
  }

  public function checkProductName($name)
  {
      if (isset($name) && strlen($name) >= 3 && strlen($name) <= 20)
          {
              $this->flag_name = 1;
          }
      elseif (isset($name))
          {
            echo "Invalid name";
            echo "<br>";
            $this->flag_name = 0;
          }

    return $this->flag_name;
  }

  public function checkProductPrice($price)
  {
      if (isset($price) && $price > 0)
          {
              $this->flag_price = 1;
          }
      elseif (isset($price))
          {
            echo "Invalid price";
            echo "<br>";
            $this->flag_price = 0;
          }

    return $this->flag_price;
  }

  public function checkProductCategory($int)
  {
      if (isset($int))
          {
              $this->flag_category = 1;
          }
      elseif (isset($int))
          {
            echo "Invalid category";
            echo "<br>";
            $this->flag_category = 0;
          }

    return $this->flag_category;
  }

}

 ?>
