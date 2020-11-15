<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function editProfile($name, $email)
    {
        $data = [
            'user_nama' => $name,
            'dateModified' => Date('Y-m-d H:i:s')
        ];

        $this->db->where('user_email', $email);
        $this->db->update('users', $data);
    }

    public function editProfileWithImage($name, $email, $image)
    {
        $data = [
            'user_nama' => $name,
            'user_image' => $image,
            'dateModified' => Date('Y-m-d H:i:s')
        ];

        $this->db->where('user_email', $email);
        $this->db->update('users', $data);
    }

    public function updatePassword($data, $email)
    {
        $this->db->where('user_email', $email);
        $this->db->update('users', $data);
    }
}