<?php

class Profile extends Controller
{

    private $model, $mail;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('ProfileModel');
        
        $this -> mail = new Mail;
        
        if (!isset($_SESSION['account_login'])) {
            $_SESSION['account_login'] = '';
        }
    }

    public function index($params = '')
    {
        if(!isset($_SESSION['id_customer'])){
            header('Location:'._WEB_ROOT.'/home');
        }

        $info = [];

        if (!isset($_SESSION['id_customer'])) {
            header('Location:' . _WEB_ROOT . '/home');
        } else if ($_SESSION['id_customer']['id'] != $params) {
            header('Location:' . _WEB_ROOT . '/home');
        }

        $customer = $this->model->getCustomerById($params);
        $customer_address = $this -> model -> getCustomerAddress($params);

        $info['customer'] = $customer;

        if($customer_address == ''){
            $_SESSION['customer_address'] = 'The default address has not been selected';
        }
        else{
            $_SESSION['customer_address'] = $customer_address;
        }

        $this->data = array(
            'title' => 'Eshop - Profile',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'profile/profile',
            'page' => 'profile/'.$_SESSION['id_customer']['id'],
            'data' => [
                'info' => $info,
                'page' => 'profile/profile_page/profile_page'
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function forget_password($params = '')
    {

        $errors = [];
        $info = [];

        if ($params) {
            $customer = $this->model->getCustomerById($params);
        } else if (is_array($params)) {
            $customer = $this->model->getCustomerById($params['id']);
            $errors = $params['errors'];
        }

        $info['errors'] = $errors;
        $info['customer'] = $customer;

        $this->data = array(
            'title' => 'Eshop - Profile',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'profile/profile',
            'page' => 'profile/'.$_SESSION['id_customer']['id'],
            'data' => [
                'info' => $info,
                'page' => 'profile/forget_password_page/forget_password_page'
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function change_password($params = '', $path = 'profile')
    {
        if(!isset($_SESSION['id_customer'])){
            header('Location:'._WEB_ROOT.'/home');
        }

        $errors = [];

        $customer = $this->model->getCustomerById($params);

        if ($_POST['new-pass'] != $_POST['current-pass']) {

            if ($_POST['new-pass'] != $_POST['confirm-pass']) {
                $errors[] = '- Wrong Repass !';
            }
        } else {
            $errors[] = '- New pass is the same current pass !';
        }

        if ($path == 'change') {
            $path = '/profile/login';
        } else {
            $path = '/' . $path . '/' . $customer['id'];
        }

        if (empty($errors)) {
            $this->model->changePassword($customer['id'], $_POST['new-pass']);
            header('Location:' . _WEB_ROOT . $path);
        } else {
            $this->forget_password([
                'errors' => $errors,
                'id' => $customer['id']
            ]);
        }
    }

    public function change_info($params = '')
    {
        if(!isset($_SESSION['id_customer'])){
            header('Location:'._WEB_ROOT.'/home');
        }

        $this->data = array(
            'title' => 'Eshop - Change Info',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'profile/profile',
            'page' => 'profile/'.$_SESSION['id_customer']['id'],
            'data' => [
                'info' => $params,
                'page' => 'profile/change_info/change_info'
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function handle_change_info($params = '')
    {

        $id_customer = $params;

        $current_avatar_path = $this->model->getIdImage($id_customer);

        if (isset($_POST['new-name']) && $_POST['new-name'] != '') {
            $this->model->updateName($id_customer, $_POST['new-name']);
            $_SESSION['id_customer']['name'] = $_POST['new-name'];
        }
        if (!$_FILES['new-avatar']['error']) {
            $upload_path = realpath('./');

            $this->model->updateAvatar($id_customer, $_FILES['new-avatar']['full_path'], $current_avatar_path);

            move_uploaded_file(
                $_FILES['new-avatar']['tmp_name'],
                $upload_path . IMG_PATH . 'customer/' . $_FILES['new-avatar']['name']
            );

            copy(
                './assest/images/customer/' . $_FILES['new-avatar']['full_path'],
                "../Eshop_Admin_mvc/assest/images/customer/"  . $_FILES['new-avatar']['full_path']
            );

            $_SESSION['id_customer']['image'] = $_FILES['new-avatar']['name'];

            if ($current_avatar_path != 'user.png') {
                unlink('./assest/images/customer/' . $current_avatar_path);
                unlink("../Eshop_Admin_mvc/assest/images/customer/"  . $current_avatar_path);
            }
        }

        header('Location:' . _WEB_ROOT . '/profile' . '/' . $id_customer);
    }

    public function find_account($email = '', $error = '')
    {
        $this->data = array(
            'title' => 'Eshop - Find Account',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'profile/profile',
            'page' => 'profile',
            'data' => [
                'info' => [
                    'email' => $email,
                    'error' => $error
                ],
                'page' => 'profile/find_account/find_account'
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function handle_find($email = '')
    {
        $data = $this->model->getCustomerByEmail($email);

        $_SESSION['id_customer'] = $data;

        $_SESSION['customer_address'] = $this -> model -> getCustomerAddress($data['id']);

        if($data['type']){
            $page = 'profile/profile_page/profile_page';
        }
        else{
            $page = 'profile/handle_find_account/handle_find_account';
        }

        $this->data = array(
            'title' => 'Eshop - Find Account',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'profile/profile',
            'page' => 'profile/'.$_SESSION['id_customer']['id'],
            'data' => [
                'info' => [
                    'account' => $data['account'],
                    'id' => $data['id'],
                    'avatar' => $data['image']
                ],
                // 'page' => 'profile/handle_find_account/handle_find_account'
                'page' => $page
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function verify_email($error = '', $path = '')
    {

        $this->data = array(
            'title' => 'Eshop - Find Account',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'profile/profile',
            'page' => 'profile/'.$_SESSION['id_customer']['id'],
            'data' => [
                'info' => [
                    'error' => $error,
                    'path' => $path
                ],
                'page' => 'profile/verify_email/verify_email'
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function check_verify_email($path = '')
    {

        $check = $this->model->checkExistEmail($_POST['verify-email']);

        if ($check) {
            $error = '- Email Existed !';
            header('Location:' . _WEB_ROOT . '/profile/verify_email/' . $error . '/' . $path);
        } else {
            header('Location:' . _WEB_ROOT . '/profile/send_email/' . $_POST['verify-email'] . '/' . $path);
        }
    }

    public function send_email($email = '', $path = '')
    {
        if (isset($_POST['find_account_email'])) {
            $path = $email;
            $email = $_POST['find_account_email'];
        }

        $code = substr(md5($email . time()), 0, 6);

        $this->model->deleteCode($email);

        $this->model->addCode($email, $code);

        $result = $this->mail ->sendEmail($email, 'user', $code);

        if ($path == 'handle_find') {
            $sub_path = 'handle_find';
            $error = '- Cannot find account !';
        } else {
            $sub_path = 'verify_email';
            $error = '- Wrong email !';
        }

        if ($result) {
            header('Location:' . _WEB_ROOT . '/profile/verify_email_code/' . $email . '/' . $path);
        } else {
            header('Location:' . _WEB_ROOT . '/profile' . '/' . $sub_path . '/' . $error . '/' . $email);
        }
    }

    public function verify_email_code($email = '', $path = '')
    {
        $this->data = array(
            'title' => 'Eshop - Find Account',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'profile/profile',
            'page' => 'profile',
            'data' => [
                'info' => [
                    'email' => $email,
                    'path' => $path,
                ],
                'page' => 'profile/verify_email_code/verify_email_code'
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function check_verify_code($email = '', $path = '')
    {
        $code = $this->model->getCode($email);

        if ($code == $_POST['verify-code']) {
            if (isset($_SESSION['id_customer'])) {
                $this->model->addEmail($email, $_SESSION['id_customer']['id']);

                $this->model->updateVerifyStatus($_SESSION['id_customer']['id'], 1);

                $_SESSION['id_customer']['verify'] = 1;
            }

            $this->model->deleteCode($email);

            unset($_SESSION['verify_errors']);

            if ($path == 'handle_find') {
                header('Location:' . _WEB_ROOT . '/profile' . '/' . $path . '/' . $email);
            } else if ($path == 'forget_password' || $path == 'new_email') {
                header('Location:' . _WEB_ROOT . '/' . $path . '/' . $_SESSION['id_customer']['id']);
            } else {
                header('Location:' . _WEB_ROOT . '/profile' . '/' . $_SESSION['id_customer']['id']);
            }
        } else {
            $_SESSION['verify_errors'] = '- Wrong code!!!  Check your email to get new code.';

            header('Location:' . _WEB_ROOT . '/profile/send_email/' . $email . '/' . $path);
        }
    }

    public function new_email($id_customer = '', $error = '')
    {
        if(!isset($_SESSION['id_customer'])){
            header('Location:'._WEB_ROOT.'/home');
        }

        $this->data = array(
            'title' => 'Eshop - Find Account',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'profile/profile',
            'page' => 'profile/'.$_SESSION['id_customer']['id'],
            'data' => [
                'info' => [
                    'id_customer' => $id_customer,
                    'error' => $error
                ],
                'page' => 'profile/new_email/new_email'
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function change_email($id_customer = '')
    {
        $checkExist = $this->model->checkExistEmail($_POST['new_email']);

        if ($checkExist) {
            $error = '- Email existed !';
            header('Location:' . _WEB_ROOT . '/new_email' . '/' . $id_customer . '/' . $error);
        }

        $this->model->addEmail($_POST['new_email'], $id_customer);
        $this->model->updateVerifyStatus($_SESSION['id_customer']['id'], 0);
        $_SESSION['id_customer']['verify'] = 0;

        header('Location:' . _WEB_ROOT . '/profile' . '/' . $id_customer);
    }

    public function edit_address(){
        if(!isset($_SESSION['id_customer'])){
            header('Location:'._WEB_ROOT.'/home');
        }

        $address = $this -> model -> getAddress($_SESSION['id_customer']['id']);

        $this->data = array(
            'title' => 'Eshop - Address',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'profile/profile',
            'page' => 'profile/'.$_SESSION['id_customer']['id'],
            'data' => [
                'info' => [
                    'address' => $address
                ],
                'page' => 'profile/edit_address/edit_address'
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function handle_edit_address($id_customer = ''){
        $address = $_POST['address'];
        $id_address = $_POST['id_address'];

        if($address != ''){
            $this -> model -> updateAddress($id_customer, $id_address, $address);
        }

        echo json_encode($address);
    }

    public function delete_address($id_customer = '', $id_address = ''){
        if(!isset($_SESSION['id_customer'])){
            header('Location:'._WEB_ROOT.'/home');
        }

        $this -> model -> deleteAddress($id_customer, $id_address);

        header('Location:'._WEB_ROOT.'/profile/edit_address');
    }

    public function set_default_address($id_customer = '', $id_address = ''){
        if(!isset($_SESSION['id_customer'])){
            header('Location:'._WEB_ROOT.'/home');
        }

        $this -> model -> updateAddressStatus($id_customer, $id_address);

        header('Location:'._WEB_ROOT.'/profile/edit_address');
    }

    public function handle_add_address($id_customer = ''){
        if(isset($_POST['address'])){
            if($_POST['address'] != ''){
                $this -> model -> addAddress($id_customer, $_POST['address']);
            }
        }

        header('Location:'._WEB_ROOT.'/profile/edit_address');
    }
}
