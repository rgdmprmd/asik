<?php defined('BASEPATH') or exit('No direct script access allowed');

// Controller admin yang menglola admin page
class Auth_model extends CI_Model
{
    public function getUserByEmail($email)
    {
        return $this->db->get_where('users', ['user_email' => $email])->row_array();
    }

    public function setUser($data)
    {
        $this->db->insert('users', $data);
    }

    public function setToken($data)
    {
        $this->db->insert('token', $data);
    }

    public function getTokenByToken($token)
    {
        return $this->db->get_where('token', ['token' => $token])->row_array();
    }

    public function emailIsVerify($email)
    {
        // Update user is active berdasarkan email yang dikirimkan
        $this->db->set('user_status', 1);
        $this->db->where('user_email', $email);
        $this->db->update('users');

        // dan hapus token yang sudah digunakan
        $this->db->delete('token', ['user_email' => $email]);
    }

    public function verifyTokenIsExpired($email)
    {
        // Jika expired, hapus data user dari table user dan token berdasarkan email yang dikirimkan
        $this->db->delete('users', ['user_email' => $email]);
        $this->db->delete('token', ['user_email' => $email]);
    }

    public function getActiveUserByEmail($email)
    {
        return $this->db->get_where('users', ['user_email' => $email, 'user_status' => 1])->row_array();
    }

    public function forgotTokenIsExpired($email)
    {
        $this->db->delete('token', ['user_email' => $email]);
    }

    public function changePassword($email, $password)
    {
        // Update passwordUser where email = $email dari table user
        $this->db->set('user_password', $password);
        $this->db->where('user_email', $email);
        $this->db->update('users');
    }

    public function getMenu()
    {
        return $this->db->get('menu')->result_array();
    }
}