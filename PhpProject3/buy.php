<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Купить доступ</title>
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
            <h3 align="center" style='color: #e0dede'>Желаете приобрести?</h3>
            <div valign="center">
                <table align='center' style='border-color: blue; background-color: lightgray; color: darkblue; font-size: 15px' border='1'>
                    <?php
                        if(isset($_GET['CS'])){
                            $name = $_GET['CS'];
                        }
                    
                        $host = "localhost";
                        $user = "root";
                        $password = "";
                        $database = "hosting";
                        $port = 3308;
                        $con = mysqli_connect($host, $user, $password, $database, $port);
                        $tab = mysqli_select_db($con, $database);
                        
                        if(isset($_GET['CS']))
                            $_SESSION['server'] = $_GET['CS'];
                        if(isset($_GET['CU']))
                            $_SESSION['user'] = $_GET['CU'];
                        $pull = "SELECT `Сервера`.`Название`,`типcервера`.`НазваниеТипа`,`Описание`,"
                                . "`Мощность`,`Ядра`,`ПЗУ_TB`,`ОЗУ_GB`,`Стоимость` FROM `типcервера`,"
                                . "`Сервера` WHERE `КодСервера`=".$_SESSION['server']." AND "
                                . "`Сервера`.`КодТипа`=`типcервера`.`КодТипа`";
                        $res = $con->query($pull);
                        ?>
                    <thead>
                        <th>Название</th>
                        <th>Тип</th>
                        <th>Описание</th>
                        <th>Мощность (ГГц)</th>
                        <th>Ядра</th>
                        <th>ПЗУ (TB)</th>
                        <th>ОЗУ (GB)</th>
                        <th>Стоимость</th>
                    </thead>
                    <tbody>
                    <?php
                    while( $row = $res->fetch_assoc() ){
                            echo "<tr><th>".$row['Название']."</th>";
                            echo "<th>".$row['НазваниеТипа']."</th>";
                            echo "<th>".$row['Описание']."</th>";
                            echo "<th>".$row['Мощность']."</th>";
                            echo "<th>".$row['Ядра']."</th>";
                            echo "<th>".$row['ПЗУ_TB']."</th>";
                            echo "<th>".$row['ОЗУ_GB']."</th>";
                            $cast = $row['Стоимость'];
                            echo "<th>".$row['Стоимость']."</th></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <br></br>
                <?php
                if(isset($_GET['buyIt'])){
                    $pull = "SELECT `КодПользователя`,`ОстатокСчёта` FROM `Пользователи`"
                            . " WHERE `Логин`='".$_SESSION['user']."'";
                    $res = $con->query($pull);
                    $row = $res->fetch_assoc();
                    $_SESSION['user'] = $row['КодПользователя'];
                    $balans = $row['ОстатокСчёта'];
                    $cast_ = $cast*$_GET['num'];
                    
                    if($balans >= $cast*$_GET['num']){
                        $date1 = date("Y-m-d");
                        $date2 = date("Y-m-d", strtotime("+".$_GET['num']." month"));
                        $pull1 = "insert into `Заказы`(`КодСервера`,`Клиент`,`Стоимость`,"
                                . "`ДатаЗаказа`,`ДатаЗавершенияОбслуживания`)"
                                . "value (".$_SESSION['server'].",".$_SESSION['user'].","
                                .$cast.",'".$date1."','".$date2."')";
                        $res1 = $con->query($pull1);
                        #if($res1 == 0){
                        $pull2 = "UPDATE `Пользователи` SET `ОстатокСчёта`=`ОстатокСчёта`-".$cast_
                                ."WHERE `КодПользователя`=".$_SESSION['user'];
                        $res2 = $con->query($pull2);
                        $pull3 = "UPDATE `Сервера` SET `Куплен`=b'1'"
                                . "WHERE `КодСервера`=".$_SESSION['server'];
                        $res3 = $con->query($pull3);
                        exit("<meta http-equiv='refresh' content='0; url= /PhpProject3/actions.php'>");
                    }
                    else{
                        echo "<h4 align='center' style='color: red'>Недостаточно средств</h4>";
                    }
                }
                ?>
                <table>
                    <th style="width: 80%">
                        <form action="" method="get">
                            <label style="font-size: 15px">
                                Количество месяцев:
                            </label>
                            <input type='number' 
                                   style='width: 30px; height: 16px;
                                   background: black; color: whitesmoke'
                                   name='num' max='5' min='1' value="1">
                            <button style='background: green; color: yellow;
                                    width: 150px; height: 20px;' name='buyIt'>
                                Подтвердить
                            </button>
                        </form>
                    </th>
                    <th style="width: 20%">
                        <form>
                            <button formaction="catalog.php" style='background: red; color: whitesmoke'>
                                Отменить и вернуться к каталогу
                            </button>
                        </form>
                    </th>
                </table>
            </div>
        </div>
        <div id="footer">&copy; Арсений Павлов</div>
    </div>
    </body>
</html>