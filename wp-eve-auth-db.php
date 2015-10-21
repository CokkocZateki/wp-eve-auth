<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); // If file is called directly, die

/*
 * Drops a column from a table
 * 
 * @param string $name  the column name to remove
 * @param string $table the table to remove the column from
 * 
 */
function drop_col($name, $table){
    global $wpdb;
    $wpdb->query( "ALTER TABLE " . $wpdb->prefix . "$table DROP COLUMN $name" );
}

/*
 * Adds a new column into a table
 * 
 * @param string $name  the new column name
 * @param string $table the table to add the column to
 * @param string $value the initial value 
 * 
 */
function add_col($name, $table, $value){
    global $wpdb;
    $row = $wpdb->get_results(  
        "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
        WHERE table_name = " . $wpdb->prefix . $table . " 
        AND column_name = $name"  
    );

    if(empty($row)){
       $wpdb->query(
           "ALTER TABLE " . $wpdb->prefix . $table . " 
            ADD 
                $name 
                VARCHAR(50)
                NOT NULL 
                DEFAULT 
                $value
        ");
    }
}