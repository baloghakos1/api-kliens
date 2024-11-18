<?php

namespace App\Html;

class PageCities extends AbstractPage
{

    static function table(array $entities)
    {
        echo '<h1>Városok</h1>';
        echo '<table id = "Cities-table">';
        self::tableHead();
        self::tableBody($entities);
        echo "</table>";
    }

    static function tableHead(){}

    static function tableBody(array $entities){}

    static function editor(){}
}