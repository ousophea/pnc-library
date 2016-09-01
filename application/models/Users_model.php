<?php
/**
 * This model contains all functions for managing users
 * @copyright  Copyright (c) 2016 Benoit Pitet
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
class users_model extends CI_Model {
    /**
     * Default constructor
     */
    public function __construct() {
    }
    /**
     * Get the list of users or one user
     * @param int $id optional id of one user
     * @return array record of users
     * @author Benoit Pitet
     */
    public function getUsers($id = 0) {
        $this->db->select('users.*');
        if ($id === 0) {
            $query = $this->db->get('users');
            return $query->result_array();
        }
        $query = $this->db->get_where('users', array('users.id' => $id));
        return $query->row_array();
    }
    /**
     * Check if a login can be used before creating the user
     * @param type $login login identifier
     * @return bool true if available, false otherwise
     * @author Benoit Pitet
     */
    public function isLoginAvailable($login) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Delete a user from the database
     * @param int $id identifier of the user
     * @author Benoit Pitet
     */
    public function deleteUser($id) {
        $query = $this->db->delete('users', array('id' => $id));
    }
    /**
     * Insert a new user into the database. Inserted data are coming from a HTML form
     * @return string deciphered password (so as to send it by e-mail in clear)
     * @author Benoit Pitet
     */
    public function setUsers() {
        //Hash the clear password using bcrypt
        $password = $this->input->post('password');
        $salt = '$2a$08$' . substr(strtr(base64_encode($this->getRandomBytes(16)), '+', '.'), 0, 22) . '$';
        $hash = crypt($password, $salt);
        // default role is simple user
        $role = 2;
        //Role field is a binary mask is passed as a parameter
        if ($this->input->post("role") != null){
           $role = 0;
           foreach($this->input->post("role") as $role_bit){
               $role = $role | $role_bit;
           }
        }
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'login' => $this->input->post('login'),
            'email' => $this->input->post('email'),
            'password' => $hash,
            'role' => $role
        );
        $this->db->insert('users', $data);

        return $password;
    }

    /**
     * Update a given user in the database. Update data are coming from a HTML form
     * @return type
     * @author Benoit Pitet
     */
    public function updateUsers() {        

        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'login' => $this->input->post('login'),
            'email' => $this->input->post('email'),
            //'role' => $role
        );

        if ($this->session->userdata('is_admin'))
        {
            //Role field is a binary mask
            $role = 0;
            foreach($this->input->post("role") as $role_bit){
                $role = $role | $role_bit;
            }
            $data['role'] = $role;
        }

        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('users', $data);
        return $result;
    }

    /**
     * Reset a password. Generate a new password and store its hash into db.
     * @param int $id User identifier
     * @return string clear password
     * @author Benoit Pitet
     */
    public function resetClearPassword($id) {
        $password = $this->randomPassword(10);

        //Hash the clear password using bcrypt (8 iterations)
        $salt = '$2a$08$' . substr(strtr(base64_encode($this->getRandomBytes(16)), '+', '.'), 0, 22) . '$';
        $hash = crypt($password, $salt);
        
        //Store the new password into db
        $data = array(
            'password' => $hash
        );
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return $password;
    }
    /**
     * Reset a password passed as parameter. Store its hash into db
     */
    public function changePassword($id, $newPassword) {
        //Hash the clear password using bcrypt (8 iterations)
        $salt = '$2a$08$' . substr(strtr(base64_encode($this->getRandomBytes(16)), '+', '.'), 0, 22) . '$';
        $hash = crypt($newPassword, $salt);
        
        //Store the new password into db
        $data = array(
            'password' => $hash
        );
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() == 1)
         {
             return true;
         }
         else {
             return false;
         }
    }
    
    /**
     * Generate a random password
     * @param int $length length of the generated password
     * @return string generated password
     * @author Benoit Pitet
     */
    private function randomPassword($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

    /**
     * Check the provided credentials
     * @param string $login user login
     * @param string $password password
     * @return bool true if the user is succesfully authenticated, false otherwise
     * @author Benoit Pitet
     */
    public function checkCredentials($login, $password) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            //No match found
            return false;
        } else {
            $row = $query->row();
            $hash = crypt($password, $row->password);
            if ($hash == $row->password) {
                // Password does match stored password.
                $this->loadProfile($row);
                return true;
            } else {
                // Password does not match stored password.
                return false;
            }
        }
    }

    private function loadProfile($row) {
                
       if (((int) $row->role & 1)) {
                    $is_admin = true;
                }
                else {
                    $is_admin = false;
                }

      $newdata = array(
                    'login' => $row->login,
                    'id' => $row->id,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname,
                    'is_admin' => $is_admin,
                    'email' => $row->email,
                    'logged_in' => TRUE
                );
       $this->session->set_userdata($newdata);
    }
    
    /**
     * Check the provided credentials and load user's profile if they are correct
     * Mostly used for alternative signin mechanisms such as SSO
     * @param string $email E-mail address of the user
     * @param string $password Optional password
     * @return bool TRUE if user was found into the database, FALSE otherwise
     */
    public function checkCredentialsEmail($email, $password = NULL) {
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            if (!is_null($password)) {
                $hash = crypt($password, $row->password);
                if ($hash == $row->password) {
                    $this->loadProfile($row);
                }
            } else {
                $this->loadProfile($row);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * Check the provided credentials for a REST Call
     * @param string $login user login
     * @param string $password password
     * @return int useridentifier if succesfully authenticated, -1 otherwise
     * @author Benoit Pitet
     */
    public function checkAuthenticationFromRest($login, $password) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            //No match found
            return false;
        } else {
            $row = $query->row();
            $hash = crypt($password, $row->password);
            if ($hash == $row->password) {
                // Password does match stored password.
                return $row->id;
            } else {
                // Password does not match stored password.
                return -1;
            }
        }
    }
    
    public function updateLastConnectionDate($id){   
        
        // Update last connection datetime utc
        $data = array(
            'last_connection_utc' => gmdate('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() == 1)
         {
             return true;
         }
         else {
             return false;
         }
    }

    /**
     * Try to return the user information from the login field
     * @param type $login
     * @return User data row or null if no user was found
     */
    public function getUserByLogin($login) {
        $this->db->from('users');
        $this->db->where('login', $login);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            //No match found
            return null;
        } else {
            return $query->row();
        }
    }

      /**
     * Try to return the user ID from the email field
     * @param type $email string
     * @return int or null if no user was found
     */
    public function getUserIdByEmail($email) {
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            //No match found
            return null;
        } else {
            return $query->row()->id;
        }
    }

        /*
        00000001 1  Admin
        00000010 2	User
        00000100 8	?
       */

    /**
     * Get the list of roles or one role
     * @param int $id optional id of one role
     * @return array record of roles
     * @author Benoit Pitet
     */
    public function getRoles($id = 0) {
        if ($id === 0) {
            $query = $this->db->get('roles');
            return $query->result_array();
        }
        $query = $this->db->get_where('roles', array('id' => $id));
        return $query->row_array();
    }

    /**
     * Generate some random bytes by using openssl, dev/urandom or random
     * @param int $count length of the random string
     * @return string a string of pseudo-random bytes (must be encoded)
     * @author Benoit Pitet
     */
    protected function getRandomBytes($length) {
        if(function_exists('openssl_random_pseudo_bytes')) {
          $rnd = openssl_random_pseudo_bytes($length, $strong);
          if ($strong === TRUE)
            return $rnd;
        }
        $sha =''; $rnd ='';
        if (file_exists('/dev/urandom')) {
          $fp = fopen('/dev/urandom', 'rb');
          if ($fp) {
              if (function_exists('stream_set_read_buffer')) {
                  stream_set_read_buffer($fp, 0);
              }
              $sha = fread($fp, $length);
              fclose($fp);
          }
        }
        for ($i=0; $i<$length; $i++) {
          $sha  = hash('sha256',$sha.mt_rand());
          $char = mt_rand(0,62);
          $rnd .= chr(hexdec($sha[$char].$sha[$char+1]));
        }
        return $rnd;
    }
}
