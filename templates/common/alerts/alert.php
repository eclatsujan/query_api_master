<?php if($is_alert): ?>
    <?php
        $icon_class=$alert_state===true?"dashicons dashicons-yes-alt":"dashicons dashicons-dismiss";
        $alert_color=$alert_state===true?"blue-grey":"bg-red-500";

    ?>
    <div class="container-fluid w-3/4">
        <div class="<?php echo $alert_color; ?> p-2 text-white font-bold">
            <span>
                <span class="<?php echo $icon_class ?>"></span>
            </span>
            <span>
                <?php echo $alert_msg; ?>
            </span>
        </div>
    </div>
<?php endif; ?>
