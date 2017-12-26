<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.pilifs.cz
 * @since      1.0.0
 *
 * @package    Igfin
 * @subpackage Igfin/admin/partials
 */
//global $wpdb;
//$table = $wpdb->prefix . 'akcie';
//$result = $wpdb->get_results("SELECT * FROM $table LIMIT 10");
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h1><?=__("Evidované akcie") ?></h1>

    <?php
    $data = $this->getPostData();
    if ($this->lastErrorMessage()) {
        echo "<div class='notice notice-error'>" . $this->lastErrorMessage() .  "</div>";
    }
    ?>
    
    <p>
        <a id="btnAdd" href="#"><?=__("Přidat akcii")?></a>
    </p>

    <div id="formAkcieAdd" style="display: <?=$this->isEditor() ? 'block' : 'none' ?>;">
        <form action="" method="post" novalidate="novalidate">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th>
                            <label for="ig_code"><?= __('Kód akcie') ?></label>
                        </th>
                        <td>
                            <input id="ig_code" class="regular-text" name="code" type="text" value="<?=$data->code ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="ig_name"><?= __('Název') ?></label>
                        </th>
                        <td>
                            <input id="ig_name" class="regular-text" name="name" type="text" value="<?=$data->name ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="ig_price"><?= __('Cena akcie') ?></label>
                        </th>
                        <td>
                            <input id="ig_price" class="regular-text" name="price" type="text" value="<?=$data->price ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="ig_desc"><?= __('Poznámka') ?></label>
                        </th>
                        <td>
                            <input id="ig_desc" class="regular-text" name="desc" type="text" value="<?=$data->desc ?>"/>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button(); ?>        
        </form>         
    </div>  

    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?= __('Vytvořeno') ?></th>
                <th><?= __('Kód') ?></th>
                <th><?= __('Název') ?></th>
                <th><?= __('Cena') ?></th>
                <th><?= __('Aktualizováno') ?></th>
                <th>...</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($this->load() as $d) {
                $created = mysql2date( 'd.m.Y H:i', $d->akcie_created );
                echo "<tr>";
                echo "<td>{$created}</td>";
                echo "<td>{$d->akcie_code}</td>";
                echo "<td>{$d->akcie_name}</td>";
                echo "<td>{$d->akcie_price}</td>";
                echo "<td>{$d->akcie_refreshed}</td>";
                echo "<td><a href='#'>XXX</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</div>