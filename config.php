<?php
    try {
        // Включаем полное отображение ошибок
        ini_set("display_errors", true);
        error_reporting(E_ALL);
        // http://www.php.net/manual/en/timezones.php
        date_default_timezone_set("Europe/Moscow");  
        //Podkluchaem klass Tovar.php
        require("Tovar.php");
    } catch (Exception $ex) {
        echo "При загрузке конфигураций возникла проблема!<br><br>";
        error_log($ex->getMessage());
        }

