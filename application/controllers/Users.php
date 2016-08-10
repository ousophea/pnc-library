<?php
/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
    /**
     * Default constructor
     * @author Benoit PITET
     */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
        $this->load->model('users_model');
    }
    
    /**
     * Display the list of all users
     * @author Benoit PITET
     */
    public function index() {
        expires_now();
        $data = getUserContext($this);
        $data['users'] = $this->users_model->getUsers();
        $data['title'] = 'List of users';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    } 
    /**
     * Display a for that allows updating a given user
     * @param int $id User identifier
     * @author Benoit PITET
     */
    public function edit($id) {
        //$this->auth->check_is_granted('edit_user');
        expires_now();
        $data = getUserContext($this);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Edit user';
        
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('login', 'login', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        //$this->form_validation->set_rules('role[]', 'role', 'required');
        
        if ($this->is_admin) {
            $this->form_validation->set_rules('role[]', 'role', 'required');
        }
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            show_404();
        }

        if ($this->form_validation->run() === FALSE) {
            $data['roles'] = $this->users_model->getRoles();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('users/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->users_model->updateUsers();
            $this->session->set_flashdata('msg', 'The user has been successfully updated');
            if (isset($_GET['source'])) {
                redirect($_GET['source']);
            } else {
                redirect('');
            }
        }
    }
    /**
     * Delete a given user
     * @param int $id User identifier
     * @author Benoit PITET
     */
    public function delete($id) { 
        //$this->auth->check_is_granted('delete_user');
        //Test if user exists
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            log_message('debug', '{controllers/users/delete} user not found');
            show_404();
        } else {
            $this->users_model->deleteUser($id);
        }
        log_message('info', 'User #' . $id . ' has been deleted by user #' . $this->session->userdata('id'));
        $this->session->set_flashdata('msg', 'The user has been successfully deleted');
        redirect('users');
    }
    /**
     * Reset the password of a user
     * Can be accessed by admin
     * @param int $id User identifier
     */
    public function resetpassword($id) {
                
        // Check that user is admin
        // TODO

        //Test if user exists
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            log_message('debug', '{controllers/users/reset} user not found');
            show_404();
        } else {
            $data = getUserContext($this);
            $data['target_user_id'] = $id;
            $data['users_item'] = $this->users_model->getUsers($id);
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password1','Password','trim|required');
            $this->form_validation->set_rules('password2','Reenter Password','trim|required|matches[password1]');

            if ($this->form_validation->run() === TRUE) {
                
                
                // Change password with new value
                $result = $this->users_model->changePassword($id, $this->input->post('password1'));
                if ($result) { // Change OK, redirect to user profile
                        
                        //Send an e-mail to the user requesting a new password
                        $this->load->library('email');
                        $this->email->set_newline("\r\n");  //Workaround FakeSMTP
                        $this->load->library('parser');
                        $target_user_email = $data['users_item']['lastname'];
                        $data = array(
                            'Title' => 'Your password has been reset',
                            'BaseURL' => base_url(),
                            'Firstname' => $data['users_item']['firstname'],
                            'Lastname' => $data['users_item']['lastname'],
                            'Login' => $data['users_item']['login'],
                            'Password' => $this->input->post('password1')
                        );
                        $message = $this->parser->parse('emails/password_forgotten', $data, TRUE);
                        if ($this->config->item('from_mail') != FALSE && $this->config->item('from_name') != FALSE ) {
                            $this->email->from($this->config->item('from_mail'), $this->config->item('from_name'));
                        } else {
                        $this->email->from('do.not@reply.me', 'League Manager');
                        }
                        $this->email->to($target_user_email);
                        $this->email->subject('[League Manager] Your password has been reset');
                        $this->email->set_mailtype("html");
                        $this->email->message($message);
                        $this->email->send();
                        
                        $this->session->set_flashdata('msg', 'The password has been changed');
                        redirect(base_url() . 'users/edit/' . $id);
                }
                else // Display error stay on same page
                {
                    $this->session->set_flashdata('error', 'An error occurs changing the user password');  
                }  
            }
            
            $data['title'] = 'Reset user password';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('users/reset-password', $data);
            $this->load->view('templates/footer', $data);  
        }
    }
    /**
     * Form validation callback : prevent from login duplication
     * @param type $login
     * @return boolean true if the field is valid, false otherwise
     * @author Benoit Pitet
     */
    public function login_check($login) {
        if (!$this->users_model->isLoginAvailable($login)) {
            $this->form_validation->set_message('login_check', 'Username already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    /**
     * Return the public user info form in read only mode
     * @param int $id User identifier
     */
    public function getPublicInfo($id) {
        //$this->auth->check_is_granted('edit_user');
        expires_now();
        $data = getUserContext($this);
        
        $data['users_item'] = $this->users_model->getUsers($id);
        if (empty($data['users_item'])) {
            show_404();
        }
        $this->load->view('users/popup', $data);        
    }   
    public function changepassword()
    {
        $data = getUserContext($this);
        $this->load->model('users_model');
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('oldpassword','Old Password','trim|required');
        $this->form_validation->set_rules('password1','Password','trim|required');
        $this->form_validation->set_rules('password2','Reenter Password','trim|required|matches[password1]');

        if ($this->form_validation->run() == FALSE)
        {
            if ($this->input->method() == 'post') {
                 $this->session->set_flashdata('error', 'Bad data');   
            }            
        } else {
            // Check old password 
            if (! $this->users_model->checkCredentials($this->login, $this->input->post('oldpassword'))) {
                $this->session->set_flashdata('error', 'Wrong password');     
            }
            else
            {
               // Change password with new value
               $result = $this->users_model->changePassword($this->user_id, $this->input->post('password1'));
               if ($result) { // Change OK, redirect to user profile
                    $this->session->set_flashdata('msg', 'Your password has been changed');             
                    redirect(base_url() . 'users/edit/' . $this->user_id);
               }
               else // Display error stay on same page
               {
                   $this->session->set_flashdata('error', 'An error occurs changing your password');  
               }              
            } 
        }   
        $data['title'] = 'Change password';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('users/change-password', $data);
        $this->load->view('templates/footer', $data);
    }
	/*
	* This function for show user state.
	*/
	public function userstate()
	{
		expires_now();
        $data = getUserContext($this);
		$data['title'] = 'List of users';
		$this->load->model('userstate_model');
        $data['user_info'] = $this->userstate_model->getUsersborrowbook();
		/* var_dump($data);
		exit; */
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('users/users_state', $data);
        $this->load->view('templates/footer');
	}
}
