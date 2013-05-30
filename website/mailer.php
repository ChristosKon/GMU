<?php
function surprise () {
	header('Location: http://www.youtube.com/watch?v=PBXVYM4zlDg');
	exit();
}
ini_set('display_errors', true);
if ($_SERVER['REQUEST_METHOD'] != 'POST')
	surprise();
if ((!isset($_POST['email'])) || (!isset($_POST['name'])) || (!isset($_POST['body'])))
	surprise();
$email = $_POST['email'];
$name = $_POST['name'];
$body = $_POST['body'];
require '../vendor/autoload.php';
$message = Swift_Message::newInstance()
-> setSubject('Greece Me Up Support [Website]')
-> setFrom(array($email => $name))
-> setTo(array('paris@sourcelair.com'))
-> setBody($body);

$credentials = explode(PHP_EOL, file_get_contents('/home/paris/.gmail'));

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
-> setUsername($credentials[0])
-> setPassword($credentials[1]);

$mailer = Swift_Mailer::newInstance($transport);
echo $mailer -> send($message);
?>
