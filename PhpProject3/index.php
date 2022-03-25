<?php session_start();
    if(!isset($_SESSION['authorize'])) $_SESSION['authorize']=null;
    if(!isset($_SESSION['login'])) $_SESSION['login']=null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Интернет-хостинг</title>
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
                height: 450px;
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
        <?php if($_SESSION['authorize'] == 0 || $_SESSION['authorize'] == null){?>
            <div>
                <table align='center' style='width: 30%'>
                    <th style='width: 50%'>
                        <a href='authorization.php' id='link_no_line' style='color: #ff810a'>Вход</a>
                    </th>
                    <th style='width: 50%'>
                        <a href='registration.php' id='link_no_line' style='color: #ff810a'>Регистрация</a>
                    </th>
                </table>
            </div>
        <?php } ?>
        <div id="content">
            <h1 align="center" style='color: #e0dede'>О ресурсе</h1>
            <div valign="center">
                <p><strong>Наш ресурс предлагает услуги по аренде серверов под разные нужды. Также, у нас есть свой форум. 
                Для того, чтобы получить доступ к серверам из каталога и вести обсуждения на форуме, вам 
                необходимо пройти регистрацию или войти под своей учётной записью.</strong></p>
            </div>
        </div>
        <div id="footer">&copy; Арсений Павлов</div>
    </div>
    </body>
</html>