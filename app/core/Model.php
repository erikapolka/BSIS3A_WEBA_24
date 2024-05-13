<?php

class Model extends Database
{



    public function __construct()
    {
        if (!property_exists($this, 'table')) {
            $this->table = strtolower($this::class) . 's'; //users
        }
    }
    public function findAll()
    {
        $query = "select * from $this->table";
        $result = $this->query($query);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function findAllOrder($column, $orderDirection = 'ASC')
    {
        $orderDirection = strtoupper($orderDirection); // Ensure the order direction is uppercase
    
        // Validate the order direction
        if ($orderDirection !== 'ASC' && $orderDirection !== 'DESC') {
            throw new Exception("Invalid order direction. Allowed values are 'ASC' or 'DESC'.");
        }
    
        $query = "SELECT * FROM $this->table ORDER BY $column $orderDirection"; // Assuming 'order_by' is the column used for sorting
        $result = $this->query($query);
    
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

  
    public function search($searchTerm, $searchColumns)
    {
        $query = "SELECT * FROM $this->table WHERE ";
        $params = [];

        foreach ($searchColumns as $column) {
            $query .= "$column LIKE ? OR ";
            $params[] = "%$searchTerm%";
        }

        $query = rtrim($query, "OR "); // Remove the last 'OR'

        return $this->query($query, $params);
    }



    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, ' && ');

        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function insert($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', :', array_keys($data));
        $query = "insert into $this->table ($columns) values (:$values)";

        $this->query($query, $data);

        return false;
    }

    public function update($id, $data, $column = "id")
    {
        $keys = array_keys($data);
        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = trim($query, ", ");

        $query .= " where $column = :$column";

        $data[$column] = $id;
        $this->query($query, $data);

        return false;
    }

    public function updateDefault($excludeId, $column, $value, $idColumn = "id")
    {
        // Update all rows to 0
        $query = "UPDATE $this->table SET $column = 0";
        $this->query($query);
    
        // Update the specific row to 1
        $query = "UPDATE $this->table SET $column = :value WHERE $idColumn = :excludeId";
        $data = array('value' => $value, 'excludeId' => $excludeId);
        $this->query($query, $data);
    
        return false;
    }



    public function delete($id, $column = 'id')
    {
        $data[$column] = $id;
        $query = "delete from $this->table where $column = :$column";

        $this->query($query, $data);

        return false;
    }

    public function first($data, $data_not = [])
  {
    $keys = array_keys($data);
    $keys_not = array_keys($data_not);

    $query = "select * from  $this->table where ";

    foreach ($keys as $key) {
      $query .= $key . " = :" . $key . " && ";
    }

    foreach ($keys_not as $key) {
      $query .= $key . " != :" . $key . " && ";
    }

    $query = trim($query, ' && ');

    $data = array_merge($data, $data_not);
    $result = $this->query($query, $data);

    if ($result) {
      return $result[0];
    }
    return false;
  }


    public function classList()
    {
        $query = "SELECT id,concat(class_course,' - ',class_level,class_section) as `class` FROM sections";
        //$query = "select * from $this->table";
        $result = $this->query($query);

        $classList = [];

        if ($result) {
            // Convert the result into an associative array
            foreach ($result as $row) {
                $classList[$row->id] = $row->class;
            }
        }

        return $classList;
    }
}
