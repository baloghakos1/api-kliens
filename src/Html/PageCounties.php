<?php
namespace App\Html;

class PageCounties extends AbstractPage {
    static function table(array $entities) {
        echo '<h1>Megyék</h1>';
        self::searchBar();
        echo '<table id="counties-table">';
        self::tableHead();
        self::tableBody($entities);
        echo '</table>'

    }

    static function tableHead() {
        echo '
        <thead>
            <tr>
                <th class="id-col">#</th>
                <th>Megnevezés</th>
                
        ';
    }

    static function editor() {

    }

    static function tableBody() {
        echo '<tbody>';
        $i = 0;
        foreach($entities as $entity) {
            $onClick = sprintf('btnEditCountyOnClick(%d, "%s")',
                $entity['id'], $entity['name']);
        }
    }
}