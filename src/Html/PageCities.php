<?php

namespace App\Html;

class PageCities extends AbstractPage
{

    static function table(array $entities, array $entities2, int $a, $abc)
    {
        echo '<h1>Városok</h1>';
        echo '<table id = "Cities-table">';
        self::tableHead($entities, $a, $abc);
        self::tableBody($entities2);
        echo "</table>";
    }

    static function tableHead(array $entities, int $a, $abc)
    {
        echo '
        <thead>
            <form name="county-select" method="post" action="" >
            <label for="counties">Válassz megyét:</label>

            <select name="counties" id="counties">';
            foreach($entities as $entity) {
                if($entity[id] == $a) {
                    echo "<option value='$entity[id]' selected>$entity[name]</option>";
                }
                else {
                    echo "<option value='$entity[id]'>$entity[name]</option>";
                }
                
            }
        echo '
            </select>
            
                <button type="submit" id="btn-select-county" name="btn-select-county" title="OK">OK</button>
            </form>';
        echo '<br><br>';
        if($abc != null) {
            foreach($abc as $betu) {
                echo '
                    <form name="ABC-'. $betu['abc'] .' "method="post" action="">
                    <input type="hidden" name="ABC-input" value='. $a .'>
                    <button type="sumbit" name="ABC-btn" id="ABC-btn" value= '.$betu['abc'].'>' . $betu['abc'] .'</button>
                    </form>
                    ';
            }
        }
        echo '<th>id</th>
            <th>Megnevezés</th>
            <th>zip kód</th>
            <th>
                Művelet&nbsp;';
        
        echo '
        
            </th>
            </tr>
            <tr id = "editor" class = "hidden"">';
            self::editor($a);
            echo '
            </tr>
            </thead>
            ';

    }

    static function tableBody(array $entities2){
        echo '<tbody>';
        $i = 0;
        foreach($entities2 as $entity)
        {
            echo "
                <tr class='" . (++$i % 2 ? "odd" : "even") . "'>
                    <td class = 'SorszamMezo'>{$entity['id']}</td>
                    <td class = 'CityMezo';>{$entity['city']}</td>
                    <td class = 'ZipCodeMezo';>{$entity['zip_code']}</td>
                    <td>
                        <form method='post' action='' class = 'ModositasBtn'>
                            <input type='hidden' name='edit_city_id' value='{$entity['id']}'>
                            <input type='hidden' name='edit_city_name' value='{$entity['city']}'>
                            <input type='hidden' name='edit_city_zip' value='{$entity['zip_code']}'>
                            <button type='submit' name='btn-edit-city' title='Módosít'>Módosítás</button>
                        </form>
                        <form method='post' action='' class = 'TorlesBtn'>
                            <button type='submit' id='btn-del-city-{$entity['id']}' name='btn-del-city' value='{$entity['id']}' title='Töröl'>Törlés</button>
                        </form>
                    </td>
                </tr>";

        }
        echo '</tbody>';
    }

    static function editor(int $a)
    {
        echo'
                <div class= "editor">
                    <th></th>
                    <th>
                        <form name="city-editor" method="post" action="" >
                            <input type="hidden" id="id" name="id">
                            <input type="hidden" id="id_county" name="id_county" value="' . $a .'">
                            <input type="search" id="city" name="city" placeholder="Város" required>
                            <input type="search" id="zip_code" name="zip_code" placeholder="Zip kód" required>
                            <button type="submit" id="btn-save-city" name="btn-save-city" title="Ment">Mentés</button>
                        </form>
                    </th>
    
                    <th class="flex">

                    </th>
                </div>
        ';
    }

    static function showModifyCities($id = null, $name = '', $zip = 0)
    {
    echo '
        <form method="post" action="">
            <input type="hidden" name="modified_city_id" value="' . htmlspecialchars($id) . '">
            <label for="modified_city_name">Város neve:</label>
            <input type="text" name="modified_city_name" value="' . htmlspecialchars($name) . '">
            <label for="modified_city_name">Város zip kódja:</label>
            <input type="number" name="modified_city_zip" value="' . htmlspecialchars($zip) . '">
            <button type="submit" name="btn-save-modified-city">Mentés</button>
        </form>';
    }

}