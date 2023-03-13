<?php
namespace PHPGrammers;
include __DIR__.'/DBConfig.php';
use PHPGrammers\DBConfig as DBconfig;
class PHPCRUDLib {
	protected $table;
  protected $conn;
  function __construct($table_name) {
		$this->table = $table_name;
    $DBconfig = new DBConfig();
    $this->conn =$DBconfig->databaseConnection();
	}
  //table fields
	protected function dbfields () {
		return $this->getFieldsOnTable();
	}
  // get tables fields
  protected function getFieldsOnTable() {
		$rows =$this->loadResultWithNoBind("SELECT column_name AS field, data_type AS type FROM information_schema.columns WHERE table_name ='".$this->table."'");
    $fields = array();
    foreach ($rows as $key => $value) {
      $fields[] = $value['field'];
}
		return $fields;
	}
  // all record in tables
	public function allRecords(){
    return $this->loadResultWithNoBind("SELECT * FROM ".$this->table);
	}
	protected function attributes() {
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach($this->dbfields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  return $attributes;
	}
	protected function sanitized_attributes() {
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $this->escape_value($value);
	  }
	  return TREUE;
	}
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	protected function create() {
		$attributes = $this->sanitized_attributes();
    for ($i=0; $i <count($attributes) ; $i++) {
      $sql_placeholder[] ="?";
    }
		$sql = "INSERT INTO ".$this->table." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES (";
		$sql .= join(",", array_values($sql_placeholder));
		$sql .= ")";
    return $this->executeQueryWithBind($attributes, $sql, $condition=null);
	}
	public function update($id=0) {
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}=?";
		}
		$sql = "UPDATE ".$this->table." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id=?";
    $condition[] =$id;
    return $this->executeQueryWithBind($attributes, $sql, $condition);
	}
	public function delete($id=0) {
		  $sql = "DELETE FROM ".$this->table;
		  $sql .= " WHERE id=?";
		  $sql .= " LIMIT 1 ";
      $condition[] =$id;
		return $this->executeQueryWithBind($attributes=null, $sql, $condition);
	}
  /* ------------------------ */
  //escape
  protected function escape_value( $value ) {
   $value = trim(strip_tags($value));
   return $value;
   }
    //sql read with no bind paramenter
    protected function loadResultWithNoBind($sql)
    {
      if (!$query = $this->conn->prepare($sql)) {
        // code...
      } else{
         $query->execute();
         $result = $query->fetchAll();
         return $result;
      }
    }
//query with bind
protected function executeQueryWithBind($attributes, $sql, $condition)
{
  if (!$query = $this->conn->prepare($sql)) {
    return false;
  } else{
    if ($attributes!=null) {
      $dataArray = array_values($attributes);
      foreach ($dataArray as $key => $values) {
        $dataValue = $values;
        $key +=1;
        $query->bindParam($key,$dataValue);
        unset($dataValue);
      }
    } else{
      $key =0;
    }
    if ($condition!=null) {
      $dataArray = array_values($condition);
      foreach ($dataArray as $_key => $values) {
        $dataValue = $values;
        $key +=1;
        $query->bindParam($key,$dataValue);
        unset($dataValue);
      }
    }
     if ($query->execute()) {
      return true;
     }else{
       return false;
     }
  }
}
}
