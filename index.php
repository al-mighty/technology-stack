<?php
//Подключаем автозагрузку композера
require_once 'vendor/autoload.php';
//Общение с базой
require_once 'PDOConnect.php';

//Экземпляр для соединения с бд
$dns=new PDOConnect('localhost','twig','root','');

if(isset($_POST['submit'])){
    $fullname=$_POST['fullname'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];

    if(empty($fullname)){
        echo 'fullname field is required!';
    }elseif (empty($phone)){
        echo '$phone field is required!';
    }elseif (empty($email)){
        echo '$email field is required!';
    }elseif (empty($subject)){
        echo '$subject field is required!';
    }elseif (empty($message)){
    echo '$message field is required!';
    }else{
        if($dns->insertRow("INSERT INTO contact(fullname,phone,email,subject,message) VALUES (?,?,?,?,?)",[$fullname,$phone,$email,$subject,$message])==TRUE){
            echo "Your Email Submited!!!";
        }else{
            echo 'error =(';
        }
    }
}
$result=$dns->getRows("SELECT * FROM contact");

//$results=DBOrm::getAllCustomers($dns);
//Авторизируем регистрируем шаблонизатор
//Twig_Autoloader::register();

//Указываем в какой папке в какой папке будут храниться наши шаблоны (В папке templates)
$loader=new Twig_Loader_Filesystem('templates');

//Создаем обьект Twig_environment Конторому передаем где хранится шаблоны
$twig=new Twig_Environment($loader,array(
//    'cache'=>'cache'
));
//Подгружаем файл с шаблоном (можем выбрать другой необходимый....)
$template=$twig->loadTemplate('index.html');
$title="Название страницы";
//пустой массив рендера для приема данных
echo $template->render(array(
    'title'=>$title,
    'reviews'=>$result
));
?>