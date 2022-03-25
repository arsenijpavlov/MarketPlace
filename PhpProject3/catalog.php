<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Каталог серверов</title>
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
                padding-left: 160px; /* Отступ слева */
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
                        <?php if($_SESSION['authorize'] == 1){?>
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
                        <?php } elseif($_SESSION['authorize'] == 3){?>
                        <table id="text_head">
                            <th style='width: 15%'>
                                <a href="addServers.php" id="link_no_line">Добавить сервер</a>
                            </th>
                            <th style='width: 15%'>
                                <a href="print_table.php" id="link_no_line">Просмотр БД</a>
                            </th>
                        </table>
                        <?php }else{ ?>
                        <table align='center' style='width: 30%' id="text_head">
                            <th style='width: 50%'>
                                <a href='authorization.php' id='link_no_line'>Вход</a>
                            </th>
                            <th style='width: 50%'>
                                <a href='registration.php' id='link_no_line'>Регистрация</a>
                            </th>
                        </table>
                        <?php } ?>
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
        <div id="sidebar">
            <p style="color: white">Сортировать:<br>
                <a href="catalog.php?sort=1" style="padding-left: 20px">цена (дёшево)</a>
                <br>
                <a href="catalog.php?sort=2" style="padding-left: 20px">цена (дорого)</a>
                <br>
                <a href="catalog.php?sort=3" style="padding-left: 20px">A-Z</a>
                <br>
                <a href="catalog.php?sort=4" style="padding-left: 20px">Z-A</a>
            </p>
            <br>
            <p style="color: white">Поиск:
                <form method='get'>
                    <table>
                        <th><input type="textarea" name="search" style="width: 100px; height: 23px"></th>
                        <th><button name="searchBtn"><img src="images/search_btn_im.png"></button></th>
                    </table>
                </form>
            </p>                
        </div>
        <div id="content">
            <h3 align="center" style='color: #e0dede'>Мы предлагаем вам...</h3>
            <div valign="center">
                <table align='center' style='border-color: blue; background-color: lightgray; color: darkblue' border='1'>
                    <?php
                        $host = "localhost";
                        $user = "root";
                        $password = "";
                        $database = "hosting";
                        $port = 3308;
                        $con = mysqli_connect($host, $user, $password, $database, $port);
                        $tab = mysqli_select_db($con, $database);
                        // echo "<tr>".$sort."</tr>";
                        $str1 = "SELECT `КодСервера`,`Название`,`НазваниеТипа`,`Стоимость` FROM `Сервера`,`типcервера` WHERE `Куплен`=0 AND `типcервера`.`КодТипа`=`Сервера`.`КодТипа` ORDER BY `Стоимость` ASC";
                        $str2 = "SELECT `КодСервера`,`Название`,`НазваниеТипа`,`Стоимость` FROM `Сервера`,`типcервера` WHERE `Куплен`=0 AND `типcервера`.`КодТипа`=`Сервера`.`КодТипа` ORDER BY `Стоимость` DESC";
                        $str3 = "SELECT `КодСервера`,`Название`,`НазваниеТипа`,`Стоимость` FROM `Сервера`,`типcервера` WHERE `Куплен`=0 AND `типcервера`.`КодТипа`=`Сервера`.`КодТипа` ORDER BY `Название` ASC";
                        $str4 = "SELECT `КодСервера`,`Название`,`НазваниеТипа`,`Стоимость` FROM `Сервера`,`типcервера` WHERE `Куплен`=0 AND `типcервера`.`КодТипа`=`Сервера`.`КодТипа` ORDER BY `Название` DESC";
                        if(isset($_GET['sort'])){
                            switch($_GET['sort']){
                            case 1:
                                $sort = $str1;
                                break;
                            case 2:
                                $sort = $str2;
                                break;
                            case 3:
                                $sort = $str3;
                                break;
                            case 4:
                                $sort = $str4;
                            }
                        }else{
                            $sort="SELECT `КодСервера`,`Название`,`НазваниеТипа`,`Стоимость` FROM "
                                    . "`Сервера`,`типcервера` WHERE `Куплен`=0 AND "
                                    . "`типcервера`.`КодТипа`=`Сервера`.`КодТипа`";
                        }
                        if(isset($_GET['searchBtn'])){
                            $search_string = $_GET['search'];
                            $sort = "SELECT * from `Сервера`,`типcервера` WHERE "
                                    . "concat(`Название`,`НазваниеТипа`,`Стоимость`) like '%".$search_string."%'"
                                    . "AND `типcервера`.`КодТипа`=`Сервера`.`КодТипа`";
                        }

                        $res = $con->query($sort);
                        while( $row = $res->fetch_assoc() ){
                            $page = "buy.php";
                            $pageEdit = "editServer";
                            $pageDel = "delServer";
                            $act = "?CS=".$row['КодСервера']."&CU=".$_SESSION['login'];
                            echo "<tr><td>Сервер: ".$row['Название']."</td>";
                            echo "<td rowspan='2'>Стоимость<br>".$row['Стоимость']."</td></tr>";
                            echo "<tr><td>Тип: ".$row['НазваниеТипа']."</td></tr>";
                            if($_SESSION['authorize'] == 1)
                                echo "<tr><td colspan='2'><a href=".$page.$act." style='color: darkgreen; "
                                    . "font-size: 20px; text-shadow: lightblue 1px 1px 0, lightblue -1px -1px 0,"
                                    . " lightblue -1px 1px 0, lightblue 1px -1px 0; padding: 5px; margin-top: 1px"
                                    . "; padding-left: 350px; padding-bottom: 20px'>"
                                    . "Купить</a></td></tr>";
                            elseif($_SESSION['authorize'] == 3){
                                echo "<tr><td colspan='2'><a href=".$pageEdit.$act." style='color: #d6bd00; "
                                    . "font-size: 20px; text-shadow: #665a01 1px 1px 0, #665a01 -1px -1px 0,"
                                    . " #665a01 -1px 1px 0, #665a01 1px -1px 0; padding: 5px; margin-top: 1px"
                                    . "; padding-left: 350px; padding-bottom: 20px'>"
                                    . "Изменить</a>";
                                echo "/";
                                echo "<a href=".$pageDel.$act." style='color: #ff3029; "
                                    . "font-size: 20px; text-shadow: #9c0202 1px 1px 0, #9c0202 -1px -1px 0,"
                                    . " #9c0202 -1px 1px 0, #9c0202 1px -1px 0; padding: 5px; margin-top: 1px"
                                    . "; padding-left: 0px; padding-bottom: 20px'>"
                                    . "Удалить</a></td></tr>";
                            }
                            else
                                echo "<tr><td colspan='2'><p style='color: green; font-size: 20px; "
                                . "text-shadow: blue 1px 1px 0, blue -1px -1px 0, blue -1px 1px 0, "
                                    . "blue 1px -1px 0; padding: 5px; margin-top: 1px'>"
                                . "Авторизуйтесь, что совершить покупку доступа</p></td></tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
        <div id="footer">&copy; Арсений Павлов</div>
    </div>
    </body>
</html>
