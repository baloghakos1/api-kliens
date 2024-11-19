<?php
namespace App\Interfaces;
 
interface PageInterface
{
    static function head();
 
    static function nav();
 
    static  function footer();
 
    static function tableHead(array $entities);
 
    static function tableBody(array $entities);
 
    static function table(array $entities, array $entities2);
 
    static function searchbar();
}