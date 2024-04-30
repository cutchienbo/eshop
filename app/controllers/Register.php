<?php
class Register extends Controller
{

    private $model;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('RegisterModel');
    }

    public function index($params = [])
    {
        if (!$params) {
            $params['old_data'] = [];
            $params['errors'] = [];
        }

        $this->data = array(
            'title' => 'Eshop - Register',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'register/register',
            'page' => 'register',
            'data' => array(
                'old_data' => $params['old_data'],
                'errors' => $params['errors']
            )
        );

        $this->render('layout/layout', $this->data);
    }

    public function register_by_google()
    {
        $client_id = '45146967433-ed8e0r8ciqfdvlh6cp1a3su6i9ll5e3m.apps.googleusercontent.com';
        $client_secret = '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';
        $redirect_uri = 'http://localhost/Eshop_mvc/register/register_by_google';

        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        $client->addScope("profile");

        $service = new Google_Service_Oauth2($client);

        $autUrl = $client->createAuthUrl();

        if (isset($_GET['code']) && $_SESSION['code'] != $_GET['code']) {
            $_SESSION['code'] = $_GET['code'];

            $client->authenticate($_GET['code']);

            $user = $service->userinfo->get();

            $this -> validate_register($user);
       
        } else {
        
            $_SESSION['code'] = '';

            header('Location:' . $autUrl);
        }
        
    }

    public function validate_register($params = '')
    {
        $error_list = [];
        $data = [];

        if ($params == '') {
            //check pass
            if ($_POST['register_pass'] === $_POST['register_repass']) {
                $data['pass'] = $_POST['register_pass'];
            } else {
                $error_list[] = 'Repass wrong !';
            }

            //check account
            if ($this->model->checkAccount($_POST['account'])) {
                $data['account'] = $_POST['account'];
            } else {
                $error_list[] = 'Account existed !';
            }

            $data['name'] = $_POST['name'];
            $data['email'] = '';
            $data['verify'] = 0;
            $data['image'] = 'user.png';
        }
        else{

            if ($this->model->checkAccount($params['id'])) {
                $data['account'] = $params['id'];
            } else {
                $error_list[] = 'Account existed !';
            }

            $data['pass'] = $params['id'];
            $data['name'] = $params['name'];
            $data['email'] = $params['email'];
            $data['verify'] = $params['verifiedEmail'];
            $data['image'] = $params['picture'];

        }

        if (empty($error_list)) {
            $new_customer = $this->model->addCustomer($data);
            $_SESSION['id_customer'] = $new_customer;
            $_SESSION['id_customer']['image'] = $data['image'];
            setcookie('id_customer', $_SESSION['id_customer']['id'], time() + 3600, "/");

            header('Location:' . _WEB_ROOT . '/profile');
        } else {
            $this->index([
                'old_data' => $data,
                'errors' => $error_list
            ]);
        }
    }
}
