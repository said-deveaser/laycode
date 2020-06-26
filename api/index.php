<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/api/vendor/autoload.php';

session_start();
ini_set('session.gc_maxlifetime', 604800);
ini_set('session.cookie_lifetime', 604800);



use model\Users;
use model\Unconfrimed;
use model\Tokens;
use classes\Helpers;
use classes\MyMail;

Helpers::controllerFuncAutoCaller("Controller");

class Controller {
    static function registry()
    {
        $model = new Users();
        $myMail = new MyMail();

        $checkExists = $model->select('*')->where([
            "email" => $_POST['email']
        ])->all();


        if (!$checkExists) {

            $_POST['email'] = mb_strtolower($_POST['email']);
            $_POST['tel'] = mb_strtolower($_POST['tel']);

            $password = Helpers::keyGen();

            $result = $model->insert([
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "password"=> password_hash($password, PASSWORD_DEFAULT),
                "tel" => $_POST['tel'],
                "prefer_time" => $_POST['prefer-time'],
            ]);

            $myMail->sendToAdmin('laycode.said@yandex.ru', "LayCode - новый ученик", [
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "tel" => $_POST['tel'],
                "prefer_time" => $_POST['prefer-time'],
            ]);

            $mailIsSend = $myMail->sendToUser($_POST['email'], "LayCode - данные для входа", [
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "password" => $password
            ]);

            $answer = [
                "status"=> "added",
                "mailIsSended" => $mailIsSend,
                "token" => $token
            ];
        } else {
            //Если запись существует
            $token = $checkExists[0]['token'];
            
            $password = Helpers::keyGen();
            $model->update([
                "password" => password_hash($password, PASSWORD_DEFAULT),
            ])->where([
                "email" => $_POST['email']
            ])->query();
            // $result = $model->insert([
            //     "name" => $_POST['name'],
            //     "email" => $_POST['email'],
            //     "password"=> password_hash($password, PASSWORD_DEFAULT),
            //     "tel" => $_POST['tel'],
            //     "prefer_time" => $_POST['prefer-time'],
            // ]);

            $myMail->sendToAdmin('laycode.said@yandex.ru', "LayCode - ученик обновил данные", [
                "email" => $_POST['email'],
            ]);

            $mailIsSend = $myMail->sendToUser($_POST['email'], "LayCode - данные для входа", [
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "password" => $password
            ]);
            $answer = [
                "status" => "exist",
                "mailIsSended" => $mailIsSend,
                "token" => $token
            ];
        }


        echo json_encode($answer);
    }
    public function sendkonsult()
    {
        //    var_dump($_POST);
       $mail = new MyMail();
       $mail->sendToAdmin('laycode.said@yandex.ru', 'Заявка на консультацию LayCode', $_POST);

    }
    public function signin()
    {
        $user = new Users();
        $result = $user->select('*')->where([
            "email" => $_POST['email']
        ])->all();
        if (!$result) {
            echo json_encode([
                "status" => "notfound",
                // "t" => password_hash("111222", PASSWORD_DEFAULT)
            ]);
        } else {
            $isVerify = false;
            foreach ($result as $key => $value) {
                if (password_verify($_POST['password'], $value['password'])) {
                    $isVerify = true;
                break;
                }
            }
            if ($isVerify) {
                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $_SESSION['token'] = $hash;
                $_SESSION['email'] = $_POST['email'];
                setcookie('token', $hash, time() + 604800, '/');
                setcookie('email', $_SESSION['email'], time() + 604800, '/');
                $token = new Tokens();
                $token->delete(["email" => $_POST['email']]);
                $token->insert([
                    "email" => $_POST['email'],
                    "session_token" => $hash
                ]);
               echo json_encode([
                   "status" => "signed"
               ]); 
            } else {
                echo json_encode([
                    "status" => "unsigned"
                ]);
            }
        }
    }
    public function userdata()
    {
        // var_dump();
        $email = Helpers::checkToken();
        if ($email) {
            $user = new Users();
            $result = $user->select('*')->where([
                "email" => $email
            ])->all();

            echo json_encode([
                "status" => "signed",
                "user" => $result[0]
            ]);
        } else {
            echo json_encode([
                "status" => "unsigned"
            ]);
        }
    }
    public function takepayment(Type $var = null)
    {
        echo "<h1> Тут буду принимать оплату</h1> <pre>";
        var_dump($_POST);
        var_dump($_GET);
    }
    public function checkreg()
    {
        $result = Helpers::checkToken();
        echo json_encode([
            "email" => $result
        ]);
    }
    public function signout()
    {
        $_SESSION["email"] = null;
        $_SESSION["token"] = null;
        $_COOKIE["email"] = null;
        $_COOKIE["token"] = null;
    }
    public function freeplaces()
    {
        $user = new Users();
        $result = $user->select("count(*)")->where([
            "buyfirst" => 1
        ])->all();
        $count = $result[0]["count(*)"];
        echo json_encode([
            "count" => $count
        ]);
    }
}





