<?php
namespace App\Interfaces;
 
interface PageInterface
{
    static function head();
 
    static function nav();
 
    static  function footer();
 
    static function tableHead(array $entities, int $a, array $abc);
 
    static function tableBody(array $entities);
 
    static function table(array $entities, array $entities2, int $a, array $abc);
 
    static function searchbar();
}