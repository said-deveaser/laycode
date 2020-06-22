<?php
$method = $_SERVER['REQUEST_METHOD'];

$picture = "";
// Если поле выбора вложения не пустое - закачиваем его на сервер
if (!empty($_FILES['rezume']['tmp_name']))
{
	if ($_FILES['rezume']['size'] < 1048576) {
		// Закачиваем файл
		$path = "rezume/" . $_FILES['rezume']['name'];
		if (copy($_FILES['rezume']['tmp_name'], $path)) $picture = $path;
		$picture = $_SERVER['HTTP_ORIGIN']. '/' . $picture;
		$_POST['Резюме'] = $picture;
	} else {
		echo "false";
		die();
	}

}


//Script Foreach
$c = true;
if ( $method === 'POST' ) {

	$project_name = trim($_POST["project_name"]);
	$admin_email  = trim($_POST["admin_email"]);
	$email_from  = trim($_POST["email_from"]);
	$form_subject = trim($_POST["form_subject"]);

	$client_email = trim($_POST["E-mail"]);
	foreach ( $_POST as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "email_from" && $key != "client_email" && $key != "form_subject" ) {
			$message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
			";
		}
	}
} else if ( $method === 'GET' ) {

	$project_name = trim($_GET["project_name"]);
	$admin_email  = trim($_GET["admin_email"]);
	$email_from  = trim($_GET["email_from"]);
	$form_subject = trim($_GET["form_subject"]);

	foreach ( $_GET as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "email_from" && $key != "form_subject" ) {
			$message .= "" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid; width: 30%;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid; width: 70%;'>$value</td>
			</tr> ";
		}
	}
}

$message = "<table style='width: 100%;'>$message</table>";

function adopt($text) {
	return '=?UTF-8?B?'.Base64_encode($text).'?=';
}

//config
$admin_email  = '4577277@mail.ru';


$headers = "MIME-Version: 1.0" . PHP_EOL .
"Content-Type: text/html; charset=utf-8" . PHP_EOL .
'From: '.adopt($project_name).' <'.$email_from.'>' . PHP_EOL .
'Reply-To: '.$admin_email.'' . PHP_EOL;



mail($admin_email, adopt($form_subject), $message, $headers);

// if (empty($picture)) {
// } else {
// 	send_mail($admin_email, adopt($form_subject), $message, $picture);
// }
//
// function send_mail($to, $thm, $html, $path)
//   {
//     $fp = fopen($path,"r");
//     if (!$fp)
//     {
//       print "Файл $path не может быть прочитан";
//       exit();
//     }
//     $file = fread($fp, filesize($path));
//     fclose($fp);
//     $boundary = "--".md5(uniqid(time())); // генерируем разделитель
//     $headers .= "MIME-Version: 1.0\n";
//     $headers .="Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
//     $multipart .= "--$boundary\n";
//     $kod = 'koi8-r'; // или $kod = 'windows-1251';
//     $multipart .= "Content-Type: text/html; charset=$kod\n";
//     $multipart .= "Content-Transfer-Encoding: Quot-Printed\n\n";
//     $multipart .= "$html\n\n";
//     $message_part = "--$boundary\n";
//     $message_part .= "Content-Type: application/octet-stream\n";
//     $message_part .= "Content-Transfer-Encoding: base64\n";
//     $message_part .= "Content-Disposition: attachment; filename = \"".$path."\"\n\n";
//     $message_part .= chunk_split(base64_encode($file))."\n";
//     $multipart .= $message_part."--$boundary--\n";
//     if(!mail($to, $thm, $multipart, $headers))
//     {
//       echo "К сожалению, письмо не отправлено";
//       exit();
//     }
//   }
