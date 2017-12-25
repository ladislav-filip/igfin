<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.pilifs.cz
 * @since             1.0.2
 * @package           Igfin
 *
 * @wordpress-plugin
 * Plugin Name:       IgFin
 * Plugin URI:        www.pilifs.cz/igfin
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.2
 * Author:            L. Filip
 * Author URI:        www.pilifs.cz
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       igfin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'IGFIN_VERSION', '1.0.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-igfin-activator.php
 */
function activate_igfin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-igfin-activator.php';
	Igfin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-igfin-deactivator.php
 */
function deactivate_igfin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-igfin-deactivator.php';
	Igfin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_igfin' );
register_deactivation_hook( __FILE__, 'deactivate_igfin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-igfin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_igfin() {

	$plugin = new Igfin();
	$plugin->run();

}
run_igfin();
