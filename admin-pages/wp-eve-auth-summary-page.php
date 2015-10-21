<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); // If file is called directly, die
/*
 * The main options page
 */
function eve_auth_summary_page(){
?>
<h2>EVE API Auth - Summary</h2>
<?php if(corpSet()){ ?>
    <h3> Alliance Info </h3>
    <table>
        <tr>
            <td align="right"> Alliance Name: </td>
            <td><?php get_option('alliance_name'); ?> </td>
        </tr>
        <tr>
            <td align="right"> Alliance ID: </td>
            <td> <?php get_option('alliance_id'); ?> </td>
        </tr>
        <tr>
            <td align="right"> Ticker: </td>
            <td> <?php get_option('alliance_ticker'); ?> </td>
        </tr>
    </table>
    
    <h3> Corporation Info </h3>
    <table>
        <tr>
            <td align="right"> Corporation Name: </td>
            <td> <?php get_option('corp_name'); ?> </td>
        </tr>
        <tr>
            <td align="right"> Corporation ID: </td>
            <td> <?php get_option('corp_id'); ?> </td>
        </tr>
        <tr>
            <td align="right"> Ticker: </td>
            <td> <?php get_option('corp_ticker'); ?> </td>
        </tr>
    </table>
    <?php 
    } else { ?>
        <p><b>Corp key not set!</b> You must add a corp key to use this plugin.</p>
<?php
    }
}
