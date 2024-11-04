<?php
namespace App\Html;

class PageCounties extends AbstractPage {
    static function table(array $entities) {
        echo '<h1>Megyék</h1>';
        //self::searchBar();
        echo '<table id="counties-table">';
        self::tableHead();
        self::tableBody($entities);
        echo '</table>';

    }

    static function tableHead() {
        echo '
        <thead>
                <tr class="sotet">
                        <th class="id-col">#</th>
                        <th>Megnevezés</th>
                        <th style="float: right; display: flex">
                            Művelet&nbsp;
                            <button id="btn-add" title="Új"><i class="fa fa-plus"></i></button>
                        </th>

                    </th>
                </tr>
                <tr id="editor" class="hidden">';
                self::editor();
                echo '
                </tr>
        </thead>
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
                type="submit"
                id="btn-search"
                name="btn-search"
                title="Keres"
            >
        </form>
        ';
    }

    static function editor() {
        echo '<p><p>';
    }

    static function tableBody(array $entities) {
        echo '<tbody>';
            $i = 0;
            foreach($entities as $entity){
                $onClick = sprintf('btnEditCountyOnClick(%d, "%s")', $entity['id'], $entity['name']);
                echo "
                <tr class='".(++$i % 2 ? "odd" : "even")."'>
                    <td>{$entity['id']}</td>
                    <td>{$entity['name']}</td>
                    <td class='flex float-right'>
                        <button type='button' id='btn-edit-{$entity['id']}' onClick='$onClick' title='Módosít'>Módosít</button>
                        <form method='post' action=''>
                            <button type='submit' id='btn-del-country-{$entity['id']}' name='btn-del-country' value='{$entity['id']}' title='Töröl'>Töröl</button>
                        </form>
                    </td>
                </tr>
                ";
            }
        echo '</tbody>';
    }
}