<?php

namespace App\html;

use App\Interfaces\PageInterface;

abstract class AbstractPage implements PageInterface {
    static function head() {
        echo '
        <!doctype html>
        <html lang="hu-hu">
        <head>
            <meta charset="utf-8">
            <meta name="viewport"
                content = "width=device-width, initial-scale=1">

            <title>REST API ügyfél</title>
        ';
    }

    static function nav() {
        echo '
        <nav>
            <form name="nav" method="post" action="index.php">
                <button type="submit" name="btn-home">Kezdőlap</button>
                <button type="sumbit" name="brn-counties">Megyék</button>
                <button type="sumbit" name="brn-cities">Városok</button>
            </form>
        </nav>
        ';
    }

    static function footer() {
        echo '
        <footer>

        </footer>
        </html>
        ';
    }

    static function SearchBar() {
        echo '
        <form method="post" action="">
            <input
                type="search"
                name="needle"
                placeholders="Keres"
            >
            <input
                type="subnit"
                id="btn-search"
                name="btn-search"
                title="Keres"
            >
        </form>
        ';
    }

    abstract function tablehead();

    abstract function tableBody(array $entities);

    abstract function table(array $entities);

    abstract function editor();

    abstract function SearchBar();
}