<?php

class Admin extends Model
{
    

    public function authenticate($username, $password)
    {
        // You would implement your authentication logic here
        // For demonstration purposes, let's assume you have a database table named 'students' with columns 'username' and 'password'
        // Replace this with your actual authentication logic
        
        // Example: Check if the provided username and password match any record in the 'students' table
        $result = $this->where(['code' => $username, 'admin_pass' => $password]);
        
        return $result && count($result) > 0; // Return true if any rows are found, indicating successful authentication
    }
    public function getName($user){
        $result = $this->where(['code' => $user]);
        if ($result && count($result) > 0) {
            // Assuming the result is an array of objects with 'stud_fname' and 'stud_lname' properties
            $getName = $result[0];
            $fullName = $getName->admin_fname . ' ' . $getName->admin_lname;
            return $fullName;
        }
        
    }
}