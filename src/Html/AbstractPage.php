<?php

namespace App\Html;

use App\Interfaces\PageInterface;

abstract class AbstractPage implements PageInterface {
    static function head() {
        echo '
        <!doctype html>
        <html lang="hu-hu">
        <head>
            <meta charset="utf-8">
            <meta name="viewport"
                content = "width=device-width", initial-scale="1">

            <title>Posta</title>
        </head>
        <body>
        ';
    }

    static function nav() {
        echo '
        <nav>
            <form name="nav" method="post" action="index.php">
                <button type="submit" name="btn-home">Kezdőlap</button>
                <button type="submit" name="btn-counties">Megyék</button>
                <button type="submit" name="btn-cities">Városok</button>
            </form>
        </nav>
        ';
    }

    static function footer() {
        echo '
        <footer>

        </footer>
        </body>
        </html>
        ';
    }

    

    abstract static function tablehead();

    abstract static function tableBody(array $entities);

    abstract static function table(array $entities);

    abstract static function editor();

    abstract static function SearchBar();
}