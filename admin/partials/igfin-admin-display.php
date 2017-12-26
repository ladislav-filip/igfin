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

$ig_alpha_apikey = get_option('ig_alpha_apikey');

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <form action="" method="post" novalidate="novalidate">
        <table class="form-table">
            <tbody>
                <tr>
                    <th>
                        <label for="ig_alpha_apikey">Alpha Vantage API key</label>
                    </th>
                    <td>
                        <input id="ig_alpha_apikey" class="regular-text" name="ig_alpha_apikey" type="text" value="<?=$ig_alpha_apikey ?>"/>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <p class="submit">
            <input type="submit" id="submit" class="button button-primary" value="Uložit"/>
        </p>
    </form>
</div>