<?php
$nds_add_meta_nonce = wp_create_nonce('paig_admin_email_form');
$email = \PAIG\Common\Option::getValue("email");
$cc_email = \PAIG\Common\Option::getValue("cc_email");
$reply_back_msg = \PAIG\Common\Option::getValue("reply_back_msg");

?>
<div id="email-settings">
    <h4 class="h4">Email Settings</h4>
    <div class="row">
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post"
              id="nds_add_user_meta_form" class="col s12">
            <input type="hidden" name="action" value="paig_admin_form">
            <input type="hidden" name="paid_admin_email_nonce" value="<?php echo $nds_add_meta_nonce ?>"/>
            <div class="row">
                <div class="input-field col s6">
                    <div class="">
                        <label for="email_address">Email Address</label>
                    </div>
                    <input id="email_address" value="<?php echo $email; ?>" name="email_address"
                           placeholder="Email Address"
                           type="text" class="validate">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <div class="">
                        <label for="email_address">CC Email Address</label>
                    </div>
                    <input id="cc_email_address" value="<?php echo $cc_email; ?>" name="cc_email_address"
                           placeholder="CC Email Address"
                           type="text" class="validate">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <div class="">
                        <label for="reply_back_msg">Reply Back Message</label>
                    </div>
                    <?php
                    $default_message_content = "<b>Thanks for reaching out! </b><br>Your message has been successfully sent. All information received will always remain confidential. One of our colleagues will get back in touch with you soon!";
                    $id = "reply_back_msg";
                    $name = 'reply_back_msg';
                    $content = !empty(wp_kses_post($reply_back_msg))?wp_kses_post($reply_back_msg):$default_message_content;
                    $settings = array(
                        'tinymce' => true,
                        'textarea_name' => $name,
                        'media_buttons'=>false,
                        'teeny'=>true,
                        'textarea_rows'=>20,
                        'editor_class'=>'h-48'
                    );
                    wp_editor($content, $id, $settings);
                    ?>
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
