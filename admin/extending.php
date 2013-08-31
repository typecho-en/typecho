<?php
include 'common.php';

$panel = $request->get('panel');
$panelTable = unserialize($options->panelTable);

if (!isset($panelTable['file']) || !in_array(urlencode($panel), $panelTable['file'])) {
    throw new Typecho_Plugin_Exception(_t('The page does not exist'), 404);
}

require_once $panel;
