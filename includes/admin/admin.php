<?php 

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

final class WPTnwCrmReferedAdmin {
    public function __construct()
    {
        add_filter( 'tnw_editor_menus', array($this, 'tnw_elavon_editor_panels') );
    }

    function tnw_elavon_editor_panels ( $panels ) {   
        $new_page = array(
            'add-panel' => array(
                'title' => 'Referidos',
                'callback' => 'add_ticket',
                'route' => TNW_ADD_DIR.'view/refered.php'
                ),
            );
        $panels = array_merge($panels, $new_page);  
        return $panels;
    }
}
new WPTnwCrmReferedAdmin();