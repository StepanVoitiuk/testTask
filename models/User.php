<?php
namespace models;
use core\Model;

class User extends Model
{
    public function getUsers() {
        return $this->db->row('SELECT id,user_name, surname, sex, age, user_group, faculty FROM users');
    }

    public function addUser($data){
       return $this->db->query("INSERT INTO users(user_name, surname, sex, age, user_group, faculty) 
                VALUES (:user_name, :surname, :sex, :age, :user_group, :faculty)",$data);
    }

    public function deleteUser($id){
        return$this->db->query("DELETE FROM users WHERE id=:id", $id);
    }

    public function getUser($id){
        return $this->db->query('SELECT id,user_name, surname, sex, age, user_group, faculty FROM users WHERE id = :id',$id);
    }
    public function updateUser($data){
        return $this->db->query('UPDATE users SET user_name = :user_name, surname= :surname, sex= :sex, age = :age, user_group=:user_group, faculty = :faculty 
            WHERE id = :id',$data);
    }
}