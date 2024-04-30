<?php
class Login extends Controller
{

    private $model;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('LoginModel');

        $_SESSION['login'] = [
            'account' => '',
            'password' => '',
        ];
    }

    public function index($params = '')
    {

        if (!is_array($params)) {
            $new_params['errors'] = '';
            $new_params['direction'] = $params;
            $_SESSION['login_direction'] = $new_params['direction'];
        } else {
            $new_params['errors'] = $params['errors'];
            $new_params['direction'] = $_SESSION['login_direction'];
        }

        $params = $new_params;

        $this->data = array(
            'title' => 'Eshop - Login',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'login/login',
            'page' => 'login',
            'errors' => $params['errors'],
            'direction' => $params['direction'],
            'aut_url' => ''
        );

        $this->render('layout/layout', $this->data);
    }

    public function captcha($micro_time = '')
    {
        $image     = imagecreatefrompng(_WEB_ROOT . IMG_PATH . 'captcha.png');

        imagefontheight(15);
        imagefontwidth(15);

        $font = '.\assest\fonts\Eater\Eater-Regular.ttf';

        $text = '';
        $captcha_code = '';
        $char = 'q.w.e.r.t.y.u.i.o.p.a.s.d.f.g.h.j.k.l.z.x.c.v.b.n.m';

        $char = explode('.', $char);

        for ($i = 0; $i < 6; $i++) {
            $num_or_char = rand(0, 1);
            if ($num_or_char) {
                $text = rand(0, 9);
                $y = 40;
            } else {
                $text = $char[rand(0, 25)];
                $y = 80;
            }

            $top_or_bot = rand(0, 1);
            if ($top_or_bot) {
                $y = 50;
            } else {
                $y = 95;
            }

            $color = imagecolorallocate($image, 50, 50, 50);

            imagettftext($image, 36, 0, 32 * ($i + 1), $y, $color, $font, $text);

            for ($j = 0; $j < 2; $j++) {
                $point_1 = rand(0, 100);
                $point_2 = rand(0, 100);

                if ($point_1 > 0 && $point_2 > 0) {
                    $rand_point = rand(0, 1);

                    if ($rand_point) {
                        $point_1 = 0;
                    } else {
                        $point_2 = 0;
                    }
                }

                $point_3 = rand(0, 100);
                $point_4 = rand(0, 100);

                if ($point_3 < 400 && $point_4 < 200) {
                    $rand_point = rand(0, 1);

                    if ($rand_point) {
                        $point_3 = 400;
                    } else {
                        $point_4 = 200;
                    }
                }

                $points = array(
                    $point_1,  $point_2,
                    $point_3, $point_4,
                    $point_3 - 2, $point_4,
                    $point_1,  $point_2 + 2,
                );

                $color = imagecolorallocate($image, rand(0, 200), rand(0, 200), rand(0, 255));

                imagefilledpolygon($image, $points, $color);
            }
            $captcha_code .= $text;
        }

        $_SESSION['captcha'] = $captcha_code;

        ob_clean();

        header("Content-Type: image/png");

        imagepng($image);

        imagedestroy($image);
    }

    public function login_by_google($params = '')
    {
        $client_id = '45146967433-ed8e0r8ciqfdvlh6cp1a3su6i9ll5e3m.apps.googleusercontent.com';
        $client_secret = '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';
        $redirect_uri = 'http://localhost/Eshop_mvc/login/login_by_google';

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

            $this->validate_login($params, $user);
        } else {
            $_SESSION['code'] = '';
            header('Location:' . $autUrl);
        }

        $_SESSION['account_login'] = "google";
    }

    public function log_out($path)
    {
        unset($_SESSION['id_customer']);
        setcookie('id_customer', '', time() - 3600, "/");

        if ($path == 'cart' || $path == 'profile') {
            $path = 'home';
        }

        header('Location:' . _WEB_ROOT . "/" . $path);
    }

    public function validate_login($params = '', $user = '')
    {
        if (!isset($_SESSION['account_login'])) {
            $_SESSION['account_login'] = '';
        }

        if (is_numeric($params)) {
            $params = 'item-' . $params;
        }

        if (isset($_POST['account'])) {
            $account = $_POST['account'];
            $password = $_POST['password'];
            $captcha = $_POST['captcha'];
        } else {
            $account = $user['id'];
            $password = substr($user['id'], 0, 16);
            $captcha = '';
        }

        if (strtolower($captcha) != $_SESSION['captcha'] && $_SESSION['account_login'] != 'google') {
            $_SESSION['login'] = [
                'account' => $account,
                'password' => $password,
            ];

            $this->index([
                'errors' => '- Wrong captcha code !',
                'direction' => $params,
            ]);
        } else {
            $data = $this->model->getCustomer($account, $password);

            if (!empty($data)) {
                $_SESSION['id_customer'] = $data[0];
                
                setcookie('id_customer', $_SESSION['id_customer']['id'], time() + 3600, "/");
                if ($_SESSION['id_customer']['status'] == '1') {
                    header('Location:' . _WEB_ROOT . '/' . $params);
                } else {
                    $_SESSION['login'] = [
                        'account' => '',
                        'password' => '',
                    ];

                    $this->index([
                        'errors' => '- Account locked !',
                        'direction' => $params,
                    ]);
                }
            } else {
                $_SESSION['login'] = [
                    'account' => '',
                    'password' => '',
                ];

                $this->index([
                    'errors' => '- Account not exist !',
                    'direction' => $params,
                ]);
            }
        }
    }
}
