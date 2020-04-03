<?php
class Admin extends CI_Controller
{
    public function index()
    {
        // echo "i am in admin controller";
        

        //validations
        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('username', 'User Name', 'required|alpha_numeric');
        // $this->form_validation->set_rules('password', 'Password', 'required|max_length[10]');
        // $this->form_validation->set_error_delimiters('<div class="text-danger"></div>');

            $username = $this->session->userdata('username');
            $userpass = $this->session->userdata('password');
        
            $this->load->model('LoginModel', 'lm');
            $this->lm->validate($username, $userpass);
            $login_id = $this->session->userdata('id');
            echo $login_id;
            exit;
            
            if($login_id)
            {
                // echo "data is there";
                $this->session->set_userdata('id', $login_id);
                // return redirect('admin/dashboard');
                $this->load->view('admin/admin_dashboard');
            }
            else
            {
                echo "data is not there";
                $this->load->view('admin/login');
            }
    }
    public function logout()
    {
        $this->session->unset_userdata('id');
        return redirect('login');
    }
    // public function dashboard()
    // {
    //     $this->load->view('admin/admin_dashboard');
    // }
}
?>