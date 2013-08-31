<?php
if (!defined('__DIR__')) {
    define('__DIR__', dirname(__FILE__));
}

/** Load the configuration file */
if (!@include_once __DIR__ . '/../config.inc.php') {
    file_exists(__DIR__ . '/../install.php') ? header('Location: ../install.php') : print('Missing Config File');
    exit;
}

/** Initializing components */
Typecho_Widget::widget('Widget_Init');

/** Registers a Initializes plug-in */
Typecho_Plugin::factory('admin/common.php')->begin();

Typecho_Widget::widget('Widget_Options')->to($options);
Typecho_Widget::widget('Widget_User')->to($user);
Typecho_Widget::widget('Widget_Notice')->to($notice);
Typecho_Widget::widget('Widget_Menu')->to($menu);

/** Initialize the context */
$request = $options->request;
$response = $options->response;

/** Test whether this is the first time you log on */
$currentMenu = $menu->getCurrentMenu();
list($prefixVersion, $suffixVersion) = explode('/', $options->version);
$params = parse_url($currentMenu[2]);
$adminFile = $params['path'];

if (!$user->logged && !Typecho_Cookie::get('__typecho_first_run') && !empty($currentMenu)) {
    
    if ('welcome.php' != $currentMenu[2]) {
        $response->redirect(Typecho_Common::url('welcome.php', $options->adminUrl));
    } else {
        Typecho_Cookie::set('__typecho_first_run', 1);
    }
    
} else {

    /** Detect whether version upgrade */
    if ($user->pass('administrator', true) && !empty($currentMenu)) {
        $mustUpgrade = (!defined('Typecho_Common::VERSION') || version_compare(str_replace('/', '.', Typecho_Common::VERSION),
        str_replace('/', '.', $options->version), '>'));

        if ($mustUpgrade && 'upgrade.php' != $currentMenu[2]) {
            $response->redirect(Typecho_Common::url('upgrade.php', $options->adminUrl));
        } else if (!$mustUpgrade && 'upgrade.php' == $currentMenu[2]) {
            $response->redirect(Typecho_Common::url('index.php', $options->adminUrl));
        } else if (!$mustUpgrade && 'welcome.php' == $currentMenu[2] && $user->logged) {
            $response->redirect(Typecho_Common::url('index.php', $options->adminUrl));
        }
    }

}
