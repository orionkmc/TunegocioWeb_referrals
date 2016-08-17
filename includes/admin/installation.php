<?php
    global $wpdb;
    $wpdb->query("ALTER TABLE {$wpdb->prefix}tnw_crm_contact ADD COLUMN referred int(11) AFTER `date`");
?>