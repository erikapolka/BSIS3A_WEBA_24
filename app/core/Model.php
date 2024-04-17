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

    public function update($id, $data, $column)
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


    public function update1($id, $data, $column = 'set_id')
    {
        // Get column names from $data array
        $keys = array_keys($data);

        // Build SET clause for the update query
        $setClause = implode(' = ?, ', $keys) . ' = ?';

        // Prepare the SQL statement
        $query = "UPDATE $this->table SET $setClause WHERE $column = ?";

        // Execute the query with data values
        $result = $this->query($query, array_merge(array_values($data), [$id]));

        // Check if update was successful
        return $result !== false;
    }


    public function delete($id, $column = 'id')
    {
        $data[$column] = $id;
        $query = "delete from $this->table where $column = :$column";

        $this->query($query, $data);

        return false;
    }


    public function classList()
    {

        $query = "SELECT class_id,concat(class_course,' - ',class_level,class_section) as `class` FROM sections";
        //$query = "select * from $this->table";
        $result = $this->query($query);

        $classList = [];

        if ($result) {
            // Convert the result into an associative array
            foreach ($result as $row) {
                $classList[$row->class_id] = $row->class;
            }
        }

        return $classList;
    }
}
