<?php

include_once("database.php");

class Category {

  private $bdd;

  public function __construct()
  {
    $this->bdd = new Database();
    $this->bdd = $this->bdd->connect();
  }

  public function addCategory($name, $parent_id)
  {
    // $bdd = new Database();
    // $bdd = $bdd->connect();
    $sql = "INSERT INTO categories (name, parent_id) VALUES (:name, :parent_id)";

    $sth = $this->bdd->prepare($sql);
    $sth->bindParam(':name', $name, PDO::PARAM_STR);
    $sth->bindParam(':parent_id', $parent_id, PDO::PARAM_STR);
    $sth->execute();
  }

  public function fetchCategoryTree($parent = 0, $spacing ='', $tree_array = '')
  {
    if (!is_array($tree_array))
      $tree_array = array();

    $sql = "SELECT id, name, parent_id FROM categories WHERE parent_id = $parent ORDER BY id ASC";
    $sth = $this->bdd->prepare($sql);
    $sth->execute();

    if ($sth->rowCount() > 0)
    {
      while ($row = $sth->fetch(PDO::FETCH_OBJ))
      {
        $tree_array[] = array("id" => $row->id, "name" => $spacing . $row->name);
        $tree_array = self::fetchCategoryTree($row->id, $spacing . '&nbsp;&nbsp;&nbsp;&nbsp;', $tree_array);
      }
    }
    return $tree_array;
  }

}

 ?>
