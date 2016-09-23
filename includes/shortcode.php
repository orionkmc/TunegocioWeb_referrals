<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

final class TunegocioWeb_referrals_FrontEnd{
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'loadScripts') );
		add_shortcode( 'tnw-crm-referido', array($this,'referrals'));
	}

	function loadScripts(){
		wp_enqueue_script('tnw_crm_jquery.min', TNW_PLUGIN_URL . 'assets/js/jquery/jquery.min.js');
		wp_enqueue_script('chartjs',  REFERRALS_PLUGIN_URL . 'assets/js/referrals.js');

		wp_enqueue_style('referrals', REFERRALS_PLUGIN_URL . 'assets/css/referrals.css');
		wp_enqueue_style('tnw_crm_bootstrap', TNW_PLUGIN_URL . 'assets/js/bootstrap/css/bootstrap.min.css');
	}

	function referrals()
    {
        global $current_user;
        global $wpdb;
        if ( $_POST['agregar'] == 'Agregar' )
        {
            extract($_POST);
            $id_wp = $wpdb->get_results("SELECT id FROM ". CRMTNW_SUBSCRIBERS ." WHERE id_wp =". $user, OBJECT);
            for ($i=0; $i < count( $Name ); $i++) {
                $wpdb->query("INSERT INTO ". CRMTNW_SUBSCRIBERS ." (`id`, `title`, `name`, `country`, `status`, `referred`) VALUES (NULL, '$Name[$i]', '$Name[$i]', '$country[$i]', '0', ". $id_wp[0]->id .");");
                $id_user[] = $wpdb->get_results('SELECT MAX(id) as id FROM ' .CRMTNW_SUBSCRIBERS )[0];
            }
            
            for ($i=0; $i < count( $id_user ); $i++) {
                $Email = explode(",", $Emails[$i]);
                foreach ($Email as $key) {
                    $wpdb->query("INSERT INTO ". CRMTNW_EMAIL ." (`id`, `email`, `subscriber`) VALUES (NULL, '". trim($key) ."', ". $id_user[$i]->id .");");
                }
                $Phone = explode(",", $Phones[$i]);
                foreach ($Phone as $key) {
                    $wpdb->query("INSERT INTO ". CRMTNW_PHONE ." (`id`, `phone`, `date`, `subscriber`) VALUES (NULL, '". trim($key) ."', '". date("Y-m-d H:i:s", time()) ."', ". $id_user[$i]->id .");");
                }

                $social_network = explode(",", $social_netwoks[$i]);
                foreach ($social_network as $key) {
                    $wpdb->query("INSERT INTO wp_crmtnw_social_netwoks (`id`, `name`, `contact`) VALUES (NULL, '". trim($key) ."', ". $id_user[$i]->id .");");
                }
            }
        }

        if (isset( $current_user->display_name )) {
            
            $countries = $wpdb->get_results("SELECT * FROM wp_crmtnw_country", OBJECT);
            ?>
            <script>
                var countries = <?= json_encode($countries) ?>;
            </script>
            <?php 
            $html = '<div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row spacer">
                        <div class="col-md-12"><b>¡Agrega tus Contactos Potenciales!</b></div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12"><input class="form-control" type="text" placeholder="Nombre del contacto" title="Nombre del contacto" name="Name[]" value="" required></div>
                            <div class="col-md-4 col-sm-4 col-xs-12"><input class="form-control" type="text" placeholder="Telefonos: +58 0416-1234567, +58 412-8910112" title="Telefonos: +58 0416-1234567, +58 412-8910112" name="Phones[]" value="" min="0"></div>
                            <div class="col-md-4 col-sm-4 col-xs-12"><input class="form-control" type="text" placeholder="Email: jose@gmail.com, josema@hotmail.com" title="Email: jose@gmail.com, josema@hotmail.com" name="Emails[]" value=""></div>
                        </div>
                        <div class="row separate">
                            <div class="col-md-8 col-sm-8 col-xs-12"><input class="form-control" type="text" placeholder="Redes Sociales: https://www.facebook.com/tunewebinfo, https://instagram.com/tunewebinfo" title="Redes Sociales: https://www.facebook.com/tunewebinfo, https://instagram.com/tunewebinfo" name="social_netwoks[]" value=""></div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <select class="form-control" name="country[]" required>
                                    <option value="" selected data-default="">Pais de Origen</option>';
                                    foreach ($countries as $country):
                                    $html .= '<option value="' .$country->PaisCodigo. '">' .$country->PaisNombre. '</option>';
                                    endforeach;
                            $html .= '</select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-12"> <button id="more" class="btn btn-default btn-block" type="button">+</button> </div>
                        </div>
                        <div id="contenedor"></div>
                        <div class="row separate">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" name="user" value="' .$current_user->ID.' ">
                                <input class="btn btn-primary btn-block" type="submit" name="agregar" value="Agregar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>';
        }
        return $html;
    }
}
new TunegocioWeb_referrals_FrontEnd();