<?php

function mce_error() {

    if( !file_exists(plugins_url() .'/Tnw_crm_base/Tnw_crm_base.php') ) {
        $mce_error_out = '<div class="error" id="messages"><p>';
        $mce_error_out .= __('No esta instalado tnw_crm_base =(', 'mce_error');
        $mce_error_out .= '</p></div>';
        echo $mce_error_out;

    } else if ( !class_exists( 'Crm_tnw') ) {

        $mce_error_out = '<div class="error" id="messages"><p>';
        $mce_error_out .= __('esta instalado tnw_crm_base pero no activado','mce_error');
        $mce_error_out .= '</p></div>';
        echo $mce_error_out;

    }
}
add_action('admin_notices', 'mce_error');