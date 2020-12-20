<?php
use PAIG\Common\Helper;
use PAIG\Common\Option;

$nds_add_meta_nonce = wp_create_nonce( 'paig_admin_oauth_form' );
$client_id=Option::getValue("client_id");

$client_id_test=Option::getValue("client_id_test");
$enable_test_mode=Option::getValue("enable_test_mode");

?>
<div id="oauth-settings">
    <h4 class="h4">Oauth Settings</h4>
    <div class="row">
        <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post"
              id="nds_add_user_meta_form" class="col s12">
            <input type="hidden" name="action" value="paig_oauth_admin_form">
            <input type="hidden" name="paid_admin_email_nonce" value="<?php echo $nds_add_meta_nonce ?>" />
            <div class="row">
                <div class="input-field col s6">
                    <div class="">
                        <label for="client_id">Client Id</label>
                    </div>
                    <input id="client_id" value="<?php echo $client_id; ?>" name="client_id" placeholder="Client Id"
                           type="text" class="validate" >
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <div class="">
                        <label for="client_secret">Client Secret</label>
                    </div>
                    <input id="client_secret" name="client_secret" placeholder="Client Secret"
                           type="password" class="validate" >
                </div>
            </div>



            <div class="row">
                <div class="input-field col s6">
                    <div class="">
                        <label for="client_id_test">Client Id (Test Mode)</label>
                    </div>
                    <input id="client_id_test" value="<?php echo $client_id_test; ?>" name="client_id_test" placeholder="Client Id Test Mode"
                           type="text" class="validate" >
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <div class="">
                        <label for="client_secret_test">Client Secret (Test Mode)</label>
                    </div>
                    <input id="client_secret_test" name="client_secret_test" placeholder="Client Secret Test Mode"
                           type="password" class="validate" >
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <div class="">
                        <label for="enable_test_mode">Enable Test Mode</label>
                    </div>
                    <select class="block" name="enable_test_mode">
                        <option value="0" <?php selected( $enable_test_mode, false); ?>>No</option>
                        <option value="1" <?php selected( $enable_test_mode, true); ?>>Yes</option>
                    </select>
                </div>
            </div>



            <div class="row">
                <div class="s12">
                    <button class="btn waves-effect waves-light">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
