<?php

/**
 * Fired during plugin activation
 *
 * @link       www.pilifs.cz
 * @since      1.0.0
 *
 * @package    Igfin
 * @subpackage Igfin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Igfin
 * @subpackage Igfin/includes
 * @author     L. Filip <ladislav.filip@gmail.com>
 */
class Igfin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
            self::createDb();
	}
        
        /**
         * 
         * Podle návodu: https://premium.wpmudev.org/blog/creating-database-tables-for-plugins/
         * @global type $wpdb
         */
        private static function createDb() {
            global $wpdb;
            $version = get_option( 'IGFIN_VERSION', '1.0.0' );
            $charset_collate = $wpdb->get_charset_collate();
            $table_name = $wpdb->prefix . 'akcie';

            $sql = "CREATE TABLE $table_name (
                akcie_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                akcie_created datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                akcie_refreshed datetime,
                akcie_code varchar(20) NOT NULL,
                akcie_name varchar(150) NOT NULL,
                akcie_price decimal(12,4) NOT NULL,
                akcie_refresh_type tinyint DEFAULT 0 NOT NULL,
                akcie_description varchar(500),
                PRIMARY KEY  akcie_id (akcie_id),
                UNIQUE KEY  akcie_code (akcie_code),
                UNIQUE KEY  akcie_name (akcie_name)                
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );  
            
            /*
            if ( version_compare( $version, '1.0.2  ' ) < 0 ) {
                $sql = "CREATE TABLE $table_name (
                    akcie_id bigint(20) UNSIGNED NOT NULL,
                    akcie_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                    akcie_refreshed datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                    akcie_code varchar(20) NOT NULL,
                    akcie_price decimal(12,4) NOT NULL,
                    akcie_refresh_type tinyint DEFAULT 0 NOT NULL,
                    akcie_description varchar(500),
                    UNIQUE KEY akcie_id (akcie_id),
                    UNIQUE KEY akcie_code (akcie_code)
                ) $charset_collate;";
                dbDelta( $sql );  
                update_option( 'my_plugin_version', '1.0.2' );
            }
            
            if ( version_compare( $version, '1.0.3  ' ) < 0 ) {
                $sql = "CREATE TABLE $table_name (
                    akcie_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                    akcie_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                    akcie_refreshed datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                    akcie_code varchar(20) NOT NULL,
                    akcie_price decimal(12,4) NOT NULL,
                    akcie_refresh_type tinyint DEFAULT 0 NOT NULL,
                    akcie_description varchar(500),
                    PRIMARY KEY akcie_id (akcie_id),
                    UNIQUE KEY akcie_code (akcie_code)
                ) $charset_collate;";
                dbDelta( $sql );  
                update_option( 'my_plugin_version', '1.0.3' );
            }    
            
            if ( version_compare( $version, '1.0.4  ' ) < 0 ) {
                $sql = "CREATE TABLE $table_name (
                    akcie_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                    akcie_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                    akcie_refreshed datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                    akcie_code varchar(20) NOT NULL,
                    akcie_name varchar(150),
                    akcie_price decimal(12,4) NOT NULL,
                    akcie_refresh_type tinyint DEFAULT 0 NOT NULL,
                    akcie_description varchar(500),
                    PRIMARY KEY  akcie_id (akcie_id),
                    UNIQUE KEY akcie_code (akcie_code)
                ) $charset_collate;";
                dbDelta( $sql );  
                update_option( 'my_plugin_version', '1.0.4' );
            }          
            */
        }

}
