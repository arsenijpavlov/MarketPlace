<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>История заказов</title>
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
                width: 120px; /* Ширина слоя */
                padding: 0 10px; /* Отступы вокруг текста */
                float: left; /* Обтекание по правому краю */
            }
            #content {
                padding: 10px; /* Поля вокруг текста */
                /*padding-left: 160px; /* Отступ слева */
                text-shadow: grey 1px 1px 0, grey -1px -1px 0, 
                             grey -1px 1px 0, grey 1px -1px 0;
                font-size: 30px;
                color: #ffffff;
                text-align: center;
                background-image: url(images/back-content.jpeg); /* Цвет фона правой колонки */
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
            #text_head{
                color: #ffe;
                font-size: 15px;
            }
            a:visited{
                color: #FDEAA8;
            }
        </style>
    </head>
    <body link="#FDEAA8">
    <div id="container">
        <div id="header">
            <table align="center">
                <tr>
                    <th style='width: 30%'>
                        <table id="text_head">
                            <th style='width: 10%'>
                                <a href="actions.php" id="link_no_line">Активные заказы</a>
                            </th>
                            <th style='width: 10%'>
                                <a href="history.php" id="link_no_line">История заказов</a>
                            </th>
                            <th style='width: 10%'>
                                <a href="money.php" id="link_no_line">Счёт</a>
                            </th>
                        </table>
                    </th>
                    <th style='width: 40%'>
                        <a href="index.php"><img src="images/logo.png" width="90" height="60" alt="Главная"></a>
                    </th>
                    <th style='width: 30%'>
                        <a href="forum.php" id="link_no_line">ФОРУМ</a>
                    </th>
                </tr>
            </table>
        </div>
        <div id="content">
            <h3 align="center" style='color: #e0dede'>Ранее Вы арендовывали...</h3>
            <div valign="center">
                <table align='center' style='border-color: blue; background-color: lightgray; color: darkblue; font-size: 15px' border='1'>
                    <?php
                        $host = "localhost";
                        $user = "root";
                        $password = "";
                        $database = "hosting";
                        $port = 3308;
                        $con = mysqli_connect($host, $user, $password, $database, $port);
                        $tab = mysqli_select_db($con, $database);
                        
                        #$user = $con->query("SELECT `КодПользователя` FROM `Пользователи` WHERE `Логин`=".$_SESSION['login'])->fetch_assoc();
                        $s = "SELECT `Фамилия`,`Имя`,`Отчество`,`Название`,`ДатаЗаказа`,`ДатаЗавершенияОбслуживания`,"
                                . "`Заказы`.`Стоимость` FROM `Пользователи`,`Сервера`,`Заказы` WHERE `КодПользователя`=`Клиент` "
                                . "AND `Сервера`.`КодСервера`=`Заказы`.`КодСервера` AND `Пользователи`.`Логин`='".$_SESSION['login']."'";
                        $res = $con->query($s);
                        ?>
                    <thead>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Название сервера</th>
                        <th>Дата аренды</th>
                        <th>Дата сдачи</th>
                        <th>Стоимость</th>
                    </thead>
                    <tbody>
                    <?php
                    while( $row = $res->fetch_assoc() ){
                            echo "<tr><th>".$row['Фамилия']."</th>";
                            echo "<th>".$row['Имя']."</th>";
                            echo "<th>".$row['Отчество']."</th>";
                            echo "<th>".$row['Название']."</th>";
                            echo "<th>".$row['ДатаЗаказа']."</th>";
                            echo "<th>".$row['ДатаЗавершенияОбслуживания']."</th>";
                            echo "<th>".$row['Стоимость']."</th></tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="footer">&copy; Арсений Павлов</div>
    </div>
    </body>
</html>