<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Таблицы БД</title>
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
            <div valign="center">
                <?php
                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "hosting";
                    $port = 3308;
                    $con = mysqli_connect($host, $user, $password, $database, $port);
                    $tab = mysqli_select_db($con, $database);

                    $pull = "SELECT * FROM `Пользователи`";
                    $res = $con->query($pull);
                ?>
                <strong align="center" style='font-size: 16px'>Таблица "Пользователи"</strong>
                <table align='center' style='border-color: blue; 
                       background-color: lightgray; color: darkblue; font-size: 15px' border='2'>
                    <thead>
                        <th>Код</th>
                        <th>Тип</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Логин</th>
                        <th>Блок</th>
                        <th>Баланс</th>
                    </thead>
                    <tbody>
                    <?php
                    while( $row = $res->fetch_assoc() ){
                            echo "<tr><th>".$row['КодПользователя']."</th>";
                            echo "<th>".$row['ТипПользователя']."</th>";
                            echo "<th>".$row['Фамилия']."</th>";
                            echo "<th>".$row['Имя']."</th>";
                            echo "<th>".$row['Отчество']."</th>";
                            echo "<th>".$row['Логин']."</th>";
                            echo "<th>".$row['Блок']."</th>";
                            echo "<th>".$row['ОстатокСчёта']."</th></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <?php
                    $pull = "SELECT * FROM `ТипCервера`";
                    $res = $con->query($pull);
                ?>
                <strong align="center" style='font-size: 16px'>Таблица "Типы серверов"</strong>
                <table align='center' style='border-color: blue; 
                       background-color: lightgray; color: darkblue; font-size: 15px' border='2'>
                    <thead>
                        <th>Код</th>
                        <th>Название</th>
                        <th>Описание</th>
                    </thead>
                    <tbody>
                    <?php
                    while( $row = $res->fetch_assoc() ){
                            echo "<tr><th>".$row['КодТипа']."</th>";
                            echo "<th>".$row['НазваниеТипа']."</th>";
                            echo "<th>".$row['Описание']."</th></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <?php
                    $pull = "SELECT * FROM `Сервера`";
                    $res = $con->query($pull);
                ?>
                <strong align="center" style='font-size: 16px'>Таблица "Сервера"</strong>
                <table align='center' style='border-color: blue; 
                       background-color: lightgray; color: darkblue; font-size: 15px' border='2'>
                    <thead>
                        <th>Код</th>
                        <th>Название</th>
                        <th>Код типа</th>
                        <th>Мощность (ГГц)</th>
                        <th>Ядра</th>
                        <th>ПЗУ (TB)</th>
                        <th>ОЗУ (GB)</th>
                        <th>Стоимость</th>
                        <th>Куплен</th>
                    </thead>
                    <tbody>
                    <?php
                    while( $row = $res->fetch_assoc() ){
                            echo "<tr><th>".$row['КодСервера']."</th>";
                            echo "<th>".$row['Название']."</th>";
                            echo "<th>".$row['КодТипа']."</th>";
                            echo "<th>".$row['Мощность']."</th>";
                            echo "<th>".$row['Ядра']."</th>";
                            echo "<th>".$row['ПЗУ_TB']."</th>";
                            echo "<th>".$row['ОЗУ_GB']."</th>";
                            echo "<th>".$row['Стоимость']."</th>";
                            echo "<th>".$row['Куплен']."</th></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <?php
                    $pull = "SELECT * FROM `Заказы`";
                    $res = $con->query($pull);
                ?>
                <strong align="center" style='font-size: 16px'>Таблица "Заказы"</strong>
                <table align='center' style='border-color: blue; 
                       background-color: lightgray; color: darkblue; font-size: 15px' border='2'>
                    <thead>
                        <th>Код</th>
                        <th>Код сервера</th>
                        <th>Код пользователя</th>
                        <th>Стоимость</th>
                        <th>Дата заказа</th>
                        <th>Дата сдачи</th>
                    </thead>
                    <tbody>
                    <?php
                    while( $row = $res->fetch_assoc() ){
                            echo "<tr><th>".$row['КодЗаказа']."</th>";
                            echo "<th>".$row['КодСервера']."</th>";
                            echo "<th>".$row['Клиент']."</th>";
                            echo "<th>".$row['Стоимость']."</th>";
                            echo "<th>".$row['Датазаказа']."</th>";
                            echo "<th>".$row['ДатаЗавершенияОбслуживания']."</th></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <?php
                    $pull = "SELECT * FROM `Темы`";
                    $res = $con->query($pull);
                ?>
                <strong align="center" style='font-size: 16px'>Таблица "Темы (Форум)"</strong>
                <table align='center' style='border-color: blue; 
                       background-color: lightgray; color: darkblue; font-size: 15px' border='2'>
                    <thead>
                        <th>Код</th>
                        <th>Название</th>
                        <th>Автор</th>
                    </thead>
                    <tbody>
                    <?php
                    while( $row = $res->fetch_assoc() ){
                            echo "<tr><th>".$row['КодТемы']."</th>";
                            echo "<th>".$row['Название']."</th>";
                            echo "<th>".$row['Автор']."</th></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <?php
                    $pull = "SELECT * FROM `Сообщения`";
                    $res = $con->query($pull);
                ?>
                <strong align="center" style='font-size: 16px'>Таблица "Сообщения (Форум)"</strong>
                <table align='center' style='border-color: blue; 
                       background-color: lightgray; color: darkblue; font-size: 15px' border='2'>
                    <thead>
                        <th>Код</th>
                        <th>Тема</th>
                        <th>Содержимое</th>
                        <th>Автор</th>
                    </thead>
                    <tbody>
                    <?php
                    while( $row = $res->fetch_assoc() ){
                            echo "<tr><th>".$row['КодСообщения']."</th>";
                            echo "<th>".$row['КодТемы']."</th>";
                            echo "<th>".$row['Содержимое']."</th>";
                            echo "<th>".$row['Автор']."</th></tr>";
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