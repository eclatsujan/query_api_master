<?php
    if ($_GET !== null) {
        $alert = isset($_GET["alert_success"]) ? $_GET["alert_success"] : "";
        $alert_class = "";
        if (isset($_GET["alert_success"])) {
            // $alert=
            $alert_class = filter_var($_GET["alert_success"], FILTER_VALIDATE_BOOLEAN);
        }
        $alert_msg = isset($_GET["alert_msg"]) ? $_GET["alert_msg"] : "";
    }
?>
<ul class="tabs">
    <li class="tab col s3"><a href="#email-settings">Email Settings</a></li>
    <li  class="tab col s3"><a href="#layout-settings">Layout Settings</a></li>
    <li  class="tab col s3"><a href="#oauth-settings">Oauth Settings</a></li>
    <li  class="tab col s3"><a href="#filter-settings">Filter Settings</a></li>
</ul>
<div class="alert">
    <?php \PAIG\Common\Helper::alert($alert,$alert_class,$alert_msg); ?>
</div>