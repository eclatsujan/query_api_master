<?php


namespace PAIG\Admin\Menus;


interface Menu
{
    public function saveOptions();

    public function verifyNonce($nonce);

    public function render();

}