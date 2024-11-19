<?php

namespace App\Html;

class PageCities extends AbstractPage
{

    static function table(array $entities, array $entities2)
    {
        echo '<h1>Városok</h1>';
        echo '<table id = "Cities-table">';
        self::tableHead($entities);
        self::tableBody($entities2);
        echo "</table>";
    }

    static function tableHead(array $entities)
    {
        echo '
        <thead>
            <label for="counties">Válassz megyét:</label>

            <select name="counties" id="counties">';
            foreach($entities as $entity) {
                echo "<option value='$entity[id]'>$entity[name]</option>";
            }
        echo '
            </select>
            <form name="county-select" method="post" action="" >
                <button type="submit" id="btn-select-county" name="btn-select-county" title="OK">OK</button>
            </form>
            <th class = "id-col">#</th>
            <th> Megnevezés </th>
            <th>
                Művelet&nbsp;';

        echo '
        
            </th>
            </tr>
            <tr id = "editor" class = "hidden"">';
            self::editor();
            echo '
            </tr>
            </thead>
            ';

    }

    static function tableBody(array $entities){
        echo '<tbody>';
        $i = 0;
        foreach($entities as $entity)
        {
            echo "
                <tr class='" . (++$i % 2 ? "odd" : "even") . "'>
                    <td class = 'SorszamMezo'>{$entity['id']}</td>
                    <td class = 'MegyeMezo';>{$entity['name']}</td>
                    <td>
                        <form method='post' action='' class = 'ModositasBtn'>
                            <input type='hidden' name='edit_county_id' value='{$entity['id']}'>
                            <input type='hidden' name='edit_county_name' value='{$entity['name']}'>
                            <button type='submit' name='btn-edit-county' title='Módosít'>Módosítás</button>
                        </form>
                        <form method='post' action='' class = 'TorlesBtn'>
                            <button type='submit' id='btn-del-county-{$entity['id']}' name='btn-del-county' value='{$entity['id']}' title='Töröl'>Törlés</button>
                        </form>
                    </td>
                </tr>";

        }
        echo '</tbody>';
    }

    static function editor(){}
}