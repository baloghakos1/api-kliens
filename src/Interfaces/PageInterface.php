<?php
namespace App\Interface;

interface PageInterface
{
    static function head();

    static function nav();

    static function footer();

    static function tablehead();

    static function tableBody(array $entities);

    static function table(array $entities);

    static function searchBar();
}