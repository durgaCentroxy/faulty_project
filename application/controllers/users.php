<?php
class Users extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('username', 'User Name', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[10]');
        $this->form_validation->set_error_delimiters('<div class="text-danger"></div>');

        if($this->form_validation->run())
        {
            $name = $this->input->post('username');
            $pass = $this->input->post('password');
            
            $this->load->model('LoginModel', 'lm');
            $id = $this->lm->validate($name, $pass);
            
            if($id)
            {
                // echo "data is there";
                $this->session->set_userdata('id', $id);
                // return redirect('admin/dashboard');
                $this->load->view('admin/admin_dashboard');
            }
            else
            {
                $username = $this->input->post('username');
                $userpass = $this->input->post('password');
                
                if($username && $userpass)
                {
                    $this->load->model('LoginModel', 'lm');
                    $id = $this->lm->validateUser($username, $userpass);
                    $get_data = $this->db->where(['userName'=>$username, 'password'=>$userpass])
                                    ->get('users');
                    $q = $get_data->row()->status;
                    if($id && $q == 1)
                {
                    
                    // echo "data is there";
                    $this->session->set_userdata('id', $id);
                    $this->session->set_userdata('username', $username);
                    // return redirect('admin/dashboard');
                    $this->load->view('users/user_dashboard1');
                    return $id;
                    return $username;
                    
                }
                elseif($id && $q == 0)
                {
                    
                    // echo "data is there";
                    $this->session->set_userdata('id', $id);
                    $this->session->set_userdata('userpass', $userpass);
                    // return redirect('admin/dashboard');
                    $this->load->view('users/user_dashboard0');
                    return $id;
                    return $userpass;
                }
                }
                else
                {
                    echo "failed";
                }
                }
        }
        else
        {
            $this->load->view('admin/login');
        }
    }

    public function csv_read()
    {
        $handle = fopen($_FILES["UploadFileName"]["tmp_name"], 'r');
        echo realpath($handle);
        // echo $handle;
        exit; 
    }
}
?>