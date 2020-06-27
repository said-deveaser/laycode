<?php

namespace classes;

$method = $_SERVER['REQUEST_METHOD'];
 
class MyMail {
    public function adopt($text) {
        return '=?UTF-8?B?'.Base64_encode($text).'?=';
    }
    public function sendToAdmin($to, $title, $arr)
    {
        $project_name = "LayCode";
        $admin_email  = "laycode.said@yandex.kz";
        $email_from  = "info@laycode.kz";
        $form_subject = $title;

        //Script Foreach
        $c = true;

        foreach ( $arr as $key => $value ) {
            $message .= "
            " . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
                <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
                <td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
            </tr>
            ";
        }


        $message = "<table style='width: 100%;'>$message</table>";

        

        //config


        $headers = "MIME-Version: 1.0" . PHP_EOL .
        "Content-Type: text/html; charset=utf-8" . PHP_EOL .
        'From: '.$this->adopt($project_name).' <'.$email_from.'>' . PHP_EOL .
        'Reply-To: '.$admin_email.'' . PHP_EOL;



        $result = mail($admin_email, $this->adopt($form_subject), $message, $headers);
        return $result;

    }
    public function sendToUser($to, $title, $arr)
    {
        $project_name = "LayCode";
        $admin_email  = $to;
        $email_from  = "info@laycode.kz";
        $form_subject = $title;

        //Script Foreach
        $c = true;

        $message = "<p>Здравствуйте, $arr[name]!</p>
        <p>Спасибо Вам, что выбрали наш курс. 
        <br>Мы недавно перешли на онлайн обучение и сделали для Вас платформу, 
        <br>чтобы вы могли следить за прогрессом своего обучения.</p>
        <p>Данные для входа в кабинет на laycode.kz</p>
                    <p><b>Email:</b> $arr[email]
                    <br><b>Пароль:</b> $arr[password]</p>
                <p>Войти в личный кабинет можно по ссылке <a href=\"https://laycode.kz/signin\">https://laycode.kz/signin</a></p>
        <p><small>Это письмо отправлено роботом - не стоит на него отвечать. 
        <br>Если у вас возникнут вопросы - <a href=\"https://laycode.kz/callback\" target=\"_blank\">https://laycode.kz/callback</a></small></p>";


        // $message = "<table style='width: 100%;'>$message</table>";


        //config


        $headers = "MIME-Version: 1.0" . PHP_EOL .
        "Content-Type: text/html; charset=utf-8" . PHP_EOL .
        'From: '.$this->adopt($project_name).' <'.$email_from.'>' . PHP_EOL .
        'Reply-To: '.$email_from.'' . PHP_EOL;



        $result = mail($admin_email, $this->adopt($form_subject), $message, $headers);
        return $result;

    }
}
