<?php
class LoginModel extends CI_Model
{
    public function validate($username, $password)
    {
        // $this->load->library('database');
        $get_data = $this->db->where(['adminName'=>$username, 'password'=>$password])
                             ->get('admin');
        if($get_data->num_rows())
        {
            return $get_data->row()->id;
            // echo "data is there";
        }
        else
        {
            // echo "data is not there";
            return false;
        }
    }
    public function validateUser($username, $password)
    {
        // $this->load->library('database');
        $get_data = $this->db->where(['userName'=>$username, 'password'=>$password])
                             ->get('users');
        if($get_data->num_rows())
        {
            return $get_data->row()->id;
            // echo "data is there";
        }
        else
        {
            // echo "data is not there";
            return false;
        }
    }
    
}
?>