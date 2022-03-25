<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Изменить информацию о сервере</title>
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
            <h3 align="center" style='color: #e0dede'>Изменить?</h3>
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
                    $row = $res->fetch_assoc();
                    echo "<tr><th>".$row['Название']."</th>";
                    echo "<th>".$row['НазваниеТипа']."</th>";
                    $serverType = $row['НазваниеТипа'];
                    echo "<th>".$row['Описание']."</th>";
                    $serverTypeLeg = $row['Описание'];
                    echo "<th>".$row['Мощность']."</th>";
                    $power = $row['Мощность'];
                    echo "<th>".$row['Ядра']."</th>";
                    $core = $row['Ядра'];
                    echo "<th>".$row['ПЗУ_TB']."</th>";
                    $PM = $row['ПЗУ_TB'];
                    echo "<th>".$row['ОЗУ_GB']."</th>";
                    $OM = $row['ОЗУ_GB'];
                    $cast = $row['Стоимость'];
                    echo "<th>".$row['Стоимость']."</th></tr>";
                    ?>
                    </tbody>
                </table>
                <p></p>
                <table>
                    <th style="width: 80%">
                        <form action="" method="get" style="font-size: 15px">
                            <table align='center'>
                                <tr>
                                    <td align='right' style='width: 300px'>
                                        <label>Название:  </label>
                                    </td>
                                    <td align='left' style='width: 300px'>
                                        <input type="textarea" value="<?php echo $row['Название']; ?>" 
                                               style='width: 200px; background-color: black;
                                               color: whitesmoke' 
                                               name='serverName' required>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='right' style='width: 100px'>
                                        <label>Тип:  </label>
                                    </td>
                                    <td align='left' style='width: 300px'><?php
                                    $pull = "SELECT * FROM `ТипCервера`";
                                    $res = $con->query($pull);

                                    echo "<select name ='serverType' style='width: 203px; background-color: black;
                                               color: whitesmoke' required>";
                                    echo "<option value='' hidden disabled selected>Выбрать</option>";
                                    while($row = $res->fetch_assoc()){
                                        echo "<option value = ".$row['КодТипа']." >"
                                            .$row['НазваниеТипа']."</option>";
                                    }
                                    echo "</select>";
                                    ?></td>
                                </tr>
                                <tr>
                                    <td align='right' style='width: 100px'>
                                        <label>Описание (для типа):  </label>
                                    </td>
                                    <td align='left' style='width: 300px;'>
                                        <input type="textarea" value="<?php echo $serverTypeLeg; ?>" 
                                               style='width: 200px; background-color: black;
                                               color: whitesmoke' name='serverTypeLeg'>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='right' style='width: 100px'>
                                        <label>Мощность (Ггц):  </label>
                                    </td>
                                    <td align='left' style='width: 300px'>
                                        <input type="number" value="<?php echo $power; ?>" 
                                               style='width: 200px; background-color: black;
                                               color: whitesmoke' name='numPow'
                                               min='0'>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='right' style='width: 100px'>
                                        <label>Ядер:  </label>
                                    </td>
                                    <td align='left' style='width: 300px'>
                                        <input type="number" value="<?php echo $core; ?>" 
                                               style='width: 200px; background-color: black;
                                               color: whitesmoke' name='numCore'
                                               min='0'>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='right' style='width: 100px'>
                                        <label>ПЗУ (TB):  </label>
                                    </td>
                                    <td align='left' style='width: 300px'>
                                        <input type="number" value="<?php echo $PM; ?>" 
                                               style='width: 200px; background-color: black;
                                               color: whitesmoke' name='numTB'
                                               min='0'>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='right' style='width: 100px'>
                                        <label>ОЗУ (GB):  </label>
                                    </td>
                                    <td align='left' style='width: 300px'>
                                        <input type="number" value="<?php echo $OM; ?>" 
                                               style='width: 200px; background-color: black;
                                               color: whitesmoke' name='numGB'
                                               min='0'>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='right' style='width: 100px'>
                                        <label>Стоимость:  </label>
                                    </td>
                                    <td align='left' style='width: 300px'>
                                        <input type="number" value="<?php echo $cast; ?>" 
                                               style='width: 200px; background-color: black;
                                               color: whitesmoke' name='cast'
                                               min='0' required>
                                    </td>
                                </tr>
                            </table>
                            <button style='background: green; color: yellow;
                                    width: 150px; height: 35px; margin-left: 206px' name='editIt'>
                                Изменить
                            </button>
                        </form>
                    </th>
                    <th style="width: 20%">
                        <form>
                            <button formaction="catalog.php" style='background: grey; 
                                    color: whitesmoke; margin-top: 199px'>
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

<?php
if(isset($_GET['editIt'])){
    $pull1 = "UPDATE `Сервера` SET `Название`='".$_GET['serverName']."',`КодТипа`="
            .$_GET['serverType'].",`Мощность`=".$_GET['numPow'].",`Ядра`=".$_GET['numCore']
            .",`ПЗУ_TB`=".$_GET['numTB'].",`ОЗУ_GB`=".$_GET['numGB'].",`Стоимость`="
            .$_GET['cast']." WHERE `КодСервера`=".$_SESSION['server'];
    $res1 = $con->query($pull1);
    $pull2 = "UPDATE `ТипCервера` SET `Описание`='".$_GET['serverTypeLeg']."' WHERE `КодТипа`=".$_GET['serverType'];
    $res2 = $con->query($pull2);
    exit("<meta http-equiv='refresh' content='0; url= /PhpProject3/catalog.php'>");
}
?>