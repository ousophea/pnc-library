<?php

/**
 * This controller contains all functions of the API.
 * @copyright  Copyright (c) 2016 Benoit PITET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Connection extends CI_Controller {

    /**
     * Default constructor
     * @author  Benoit PITET
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }

    /**
     * Login form
     * @author  Benoit PITET
     */
    public function login() {
        $data['title'] = 'Login to the application';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('login', 'login', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $data['oauth2_enabled'] = $this->config->item('oauth2_enabled');
        $data['classic_form_enabled'] = $this->config->item('classic_form_enabled');
        if ($this->form_validation->run() === FALSE) {
            $data['flash_partial_view'] = $this->load->view('templates/flash-connection', $data, true);
            $this->load->view('templates/header', $data);
            $this->load->view('connection/login', $data);
            $this->load->view('templates/footer');
        } else {
            $loggedin = $this->users_model->checkCredentials($this->input->post('login'), $this->input->post('password'));

            if ($loggedin == FALSE) {
                log_message('error', '{controllers/session/login} Invalid login id or password for user=' . $this->input->post('login'));
                $this->session->set_flashdata('msg', 'Bad credentials');
                $data['flash_partial_view'] = $this->load->view('templates/flash-connection', $data, true);
                $this->load->view('templates/header', $data);
                $this->load->view('connection/login', $data);
                $this->load->view('templates/footer');
            } else {
//If the user has a target page (e.g. link in an e-mail), redirect to this destination
                if ($this->session->userdata('last_page') != '') {
                    redirect($this->session->userdata('last_page'));
                } else {
// if admin redirect to admin page
                    if ($this->session->userdata('is_admin')) {
                        redirect('dashboard');
                    }
// if simple user redirect to page account state
                    redirect('account/accountState');
                }
            }
        }
    }

    /**
     * Logout the user and destroy the session data
     * @author  Benoit PITET
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('connection/login');
    }

    /**
     * Send the password by e-mail to a user requesting it
     * @author  Benoit PITET
     */
    public function forgetpassword() {
        expires_now();
        $this->output->set_content_type('text/plain');
        $login = $this->input->post('login');
        $user = $this->users_model->getUserByLogin($login);
        if (is_null($user)) {
            echo "UNKNOWN";
        } else {
//Generate random password and store its hash into db
            $password = $this->users_model->resetClearPassword($user->id);

//Send an e-mail to the user requesting a new password
            $this->load->library('email');
            $this->email->set_newline("\r\n");  //Workaround FakeSMTP
            $this->load->library('parser');
            $data = array(
                'Title' => 'Your password has been reset',
                'BaseURL' => base_url(),
                'Firstname' => $user->firstname,
                'Lastname' => $user->lastname,
                'Login' => $user->login,
                'Password' => $password
            );
            $message = $this->parser->parse('emails/password_forgotten', $data, TRUE);
            if ($this->config->item('from_mail') != FALSE && $this->config->item('from_name') != FALSE) {
                $this->email->from($this->config->item('from_mail'), $this->config->item('from_name'));
            } else {
                $this->email->from('do.not@reply.me', 'League Manager');
            }
            $this->email->to($user->email);
            $this->email->subject('[League Manager] Your password has been reset');
            $this->email->set_mailtype("html");
            $this->email->message($message);
            $this->email->send();
            echo "OK";
        }
    }

    public function register() {
        log_message('info', 'Register method called');

        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Register';
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('login', 'login', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password2', 'password2', 'required');
        $this->form_validation->set_rules('password', 'password', 'required|matches[password2]');

        if ($this->form_validation->run() === FALSE) {
            log_message('info', 'Form not validated');
            $this->load->view('templates/header', $data);
            $this->load->view('connection/register', $data);
        } else {
            log_message('info', 'Form validated');
// Calling model method to create user
            $password = $this->users_model->setUsers();
            $this->session->set_flashdata('msg', 'Your account has been succesfully created');
            redirect('connection/login');
        }
    }

    /**
     * Ajax endpoint : check login duplication
     * @author Benoit PITET
     */
    public function check_login() {
        header("Content-Type: text/plain");
        if ($this->users_model->isLoginAvailable($this->input->post('login'))) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     * Try to authenticate the user using one of the OAuth2 providers
     */
    public function loginOAuth2() {

        $this->load->library('OAuthC');

        $oauth2Enabled = $this->config->item('oauth2_enabled');
        $client_id = $this->config->item('oauth2_client_id');
        $client_secret = $this->config->item('oauth2_client_secret');
        $redirect_uri = $this->config->item('oauth2_redirect_url');

        $provider = new League\OAuth2\Client\Provider\Google([
            'clientId' => $client_id,
            'clientSecret' => $client_secret,
            'redirectUri' => $redirect_uri,
            'hostedDomain' => '',
        ]);

        if (!empty($_GET['error'])) {

            $this->session->sess_destroy();

// Got an error, probably user denied access
            exit('Got error: ' . $_GET['error']);
        } elseif (empty($_GET['code'])) {

// If we don't have an authorization code then get one, go to google authentification form
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: ' . $authUrl);
            exit;
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

            $this->session->sess_destroy();

// State is invalid, possible CSRF attack in progress
            unset($_SESSION['oauth2state']);
            exit('Invalid state');
        } else {

// Try to get an access token (using the authorization code grant)
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);

// Optional: Now you have a token you can look up a users profile data
            try {

// We got an access token, let's now get the owner details
                $ownerDetails = $provider->getResourceOwner($token); //GoogleUser
// Register new user or connect existing one 
                $details = $ownerDetails->toArray();
                $firstName = $ownerDetails->getFirstName();
                $lastName = $ownerDetails->getLastName();
                $email = $ownerDetails->getEmail();
                $login = $ownerDetails->getName();

//If we find the e-mail address into the database, we're good
                $loggedin = $this->users_model->checkCredentialsEmail($email);

                if ($loggedin) { // means account already exists
// Update last connection time
                    $id = $this->users_model->getUserIdByEmail($email);
                    $this->users_model->updateLastConnectionDate($id);
                } else { // Need to create new account on database
// Create Account
// We inject into the POST variable all informations required to create the Account like if the user register
// Calling model method to create user
                    $_POST['firstname'] = $firstName;
                    $_POST['lastname'] = $lastName;
                    $_POST['login'] = $login;
                    $_POST['email'] = $email;
                    $this->users_model->setUsers();
                    $this->session->set_flashdata('msg', 'Welcome into PNC Library. Your account has been created');

// check credentials again, will start the session
                    $loggedin = $this->users_model->checkCredentialsEmail($email);
                    if ($loggedin) {
// update last connection dateTime
                        $id = $this->users_model->getUserIdByEmail($email);
                        $this->users_model->updateLastConnectionDate($id);
                    }
                }

// Redirect to home page, when authentification is done
//If the user has a target page redirect to this destination
                if ($this->session->userdata('last_page') != '') {
                    redirect($this->session->userdata('last_page'));
                } else {
                    redirect(base_url());
                }
            } catch (Exception $e) {

// Failed to get user details
                exit('Something went wrong: ' . $e->getMessage());
            }

// Use this to interact with an API on the users behalf
//echo $token->accessToken;
// Use this to get a new access token if the old one expires
//echo $token->refreshToken;
// Number of seconds until the access token will expire, and need refreshing
//echo $token->expires;
        }
        $this->google->setClientId($client_id);
        $this->google->setClientSecret($client_secret);
        $this->google->setRedirectUri($redirect_uri);
        $this->google->addScope("email");
        $this->google->addScope("profile");
//$service = new Google_Service_Oauth2($client);
        /*         * **********************************************
         * If we're logging out we just need to clear our
         * local access token in this case
         * ********************************************** */
        if (isset($_REQUEST['logout'])) {
            unset($_SESSION['id_token_token']);
        }
        /*         * **********************************************
         * If we have a code back from the OAuth 2.0 flow,
         * we need to exchange that with the
         * Google_Client::fetchAccessTokenWithAuthCode()
         * function. We store the resultant access token
         * bundle in the session, and redirect to ourself.
         * ********************************************** */
        if (isset($_GET['code'])) {
            $token = $this->google->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->google->setAccessToken($token);

// store in the session also
            $_SESSION['id_token_token'] = $token;

// redirect back to the example
            header('Location: ' . filter_var($redirect_uri, $FILTER_SANITIZE_URL));
        }
        /*         * **********************************************
          If we have an access token, we can make
          requests, else we generate an authentication URL.
         * ********************************************** */
        if (
                !empty($_SESSION['id_token_token']) && isset($_SESSION['id_token_token']['id_token'])
        ) {
            $this->google->setAccessToken($_SESSION['id_token_token']);
        } else {
            $authUrl = $this->google->createAuthUrl();
        }
        /*         * **********************************************
          If we're signed in we can go ahead and retrieve
          the ID token, which is part of the bundle of
          data that is exchange in the authenticate step
          - we only need to do a network call if we have
          to retrieve the Google certificate to verify it,
          and that can be cached.
         * ********************************************** */
        if ($this->google->getAccessToken()) {
            $token_data = $this->google->verifyIdToken();
            echo $token_data;
        }
    }

}
