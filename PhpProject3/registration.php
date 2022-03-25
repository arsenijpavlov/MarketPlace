<!DOCTYPE html>
<html>
    <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Регистрация</title>
  <style type="text/css">
   body {
    font: 10pt Arial, Helvetica, sans-serif; /* Шрифт на веб-странице */
    background: #e1dfb9; /* Цвет фона */
   }
   h2 {
    font-size: 1.1em; /* Размер шрифта */
    color: #800040; /* Цвет текста */
    margin-top: 0; /* Отступ сверху */
   }
   #container {
    width: 800px; /* Ширина слоя */
    margin: 0 auto; /* Выравнивание по центру */
    background: #f0f0f0; /* Цвет фона левой колонки */
   }
   #header {
    font-size: 2.2em; /* Размер текста */
    text-align: center; /* Выравнивание по центру */
    padding: 10px; /* Отступы вокруг текста */
    background: #3498eb; /* Цвет фона шапки */
    color: #ffe; /* Цвет текста */
   }
   #header_1{
    font-size: 15px; /* Размер текста */
    text-align: center; /* Выравнивание по центру */
    padding: 2px; /* Отступы вокруг текста */
    background: #52cbe3; /* Цвет фона шапки */
   }
   #sidebar {
    margin-top: 10px; 
    width: 110px; /* Ширина слоя */
    padding: 0 10px; /* Отступы вокруг текста */
    float: left; /* Обтекание по правому краю */
   }
   #content {
    padding: 10px; /* Поля вокруг текста */
    background: #fff; /* Цвет фона правой колонки */
   }
   #footer {
    background: #8fa09b; /* Цвет фона подвала */
    color: #fff; /* Цвет текста */
    padding: 5px; /* Отступы вокруг текста */
    clear: left; /* Отменяем действие float */
   }
   #link_no_line{
       text-decoration: none;
   }
  </style>
 </head>
 <body link="#FDEAA8">
  <div id="container">
      <div id="header">
        <table align="center">
            <tr>
                <th style='width: 25%'>
                    <a href="catalog.php" id="link_no_line">КАТАЛОГ</a>
                </th>
                <th style='width: 50%'>
                    <a href="index.php"><img src="images/logo.png" width="90" height="60" alt="Главная"></a>
                </th>
                <th style='width: 25%'>
                    <a href="forum.php" id="link_no_line">ФОРУМ</a>
                </th>
            </tr>
        </table>
      </div>
   <div id="content">
    <h2 align="center">Регистрация нового пользователя</h2>
    <p align='center'>Для регистрации на сайте заполните анкету ниже и нажмите "Подтвердить"</p>
    <?php
        if(isset($_POST["SendRegistry"])){
            $val = 0;
            $host = "localhost";
            $user = "root";
            $password = "";
            $database = "hosting";
            $port = 3308;
            $con = mysqli_connect($host, $user, $password, $database, $port);
            $tab = mysqli_select_db($con, $database);
            
            $lastname1 = $_POST['lastname1'];
            $name = $_POST['name'];
            $lastname2 = $_POST['lastname2'];
            $login = $_POST['login'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            
            $res = $con->query("SELECT COUNT(*) FROM `Пользователи` WHERE `Логин`='".$login."'");
            $res->data_seek(0);
            $count = $res->fetch_array();
            $count = $count[0]; //результат запроса
            if($count != 0) $val++;
            
            if($val != 0){
                //echo "<p align='center' style='color: red'><strong>Неправильное заполнение!<br>Попробуйте ещё раз</strong></p>";            
                if($count != 0){
                    echo "<p align='center' style='color: red'>Пользователь с таким логином уже существует. "
                    . "Пожалуйста, выберите другой.</p><br>";
                }
            }
            else{
                if($pass1 == $pass2){
                    $query = "insert into Пользователи(ТипПользователя, Фамилия, Имя, Отчество, Логин, Пароль, ОстатокСчёта)".
                        "values('Клиент', '". $lastname1. "', '". $name. "', '". $lastname2. "', '". $login. "', '". $pass1. "', 0);";
                    $res = mysqli_query($con, $query);
                    header("Location: index.php");
                    exit();
                }else{
                    echo "<p align='center' style='color: red'>Пароли не совпадают!</p><br>";
                }
            }
        }
    ?>
    <table>
        <td style="width: 20%" />
        <td style="width: 60%"><form name="anketa" method="POST" action="">
        <table align='center'>
            <tr>
                <td>Ваша фамилия:</td>
                <td><input type="textarea" name="lastname1" required></td>
            </tr>
            <tr>
                <td>Ваше имя:</td>
                <td><input type="textarea" name="name" required></td>
            </tr>
            <tr>
                <td>Ваше отчество (при наличии):</td>
                <td><input type="textarea" name="lastname2"></td>
            </tr>
            <tr>
                <td>Логин:</td>
                <td><input type="textarea" name="login" required></td>
            </tr>
            <tr>
                <td>Пароль:</td>
                <td><input type="textarea" name="pass1" required></td>
            </tr>
            <tr>
                <td style="padding-top: 30px">Подтвердите пароль:</td>
                <td style="padding-top: 30px"><input type="textarea" name="pass2" required></td>
            </tr>
        </table>
        <table align="center" style="padding-top: 30px; width: 50%;">
            <td align="center">
                <input type="submit" name="SendRegistry" value="Подтвердить">
            </td>
        </table>
        </form></td>
        <td style="width: 20%" valign="bottom">
            <form><button formaction="index.php">Отменить и вернуться на главную </button></form>
        </td>
    </table>
   </div>
   <div id="footer">&copy; Арсений Павлов</div>
  </div> 
 </body>
</html>