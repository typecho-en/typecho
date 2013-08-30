<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="typecho-head-guid body-950">
    <dl id="typecho:guid">
        <?php $menu->output(); ?>
    </dl>
    <p class="operate"><?php Typecho_Plugin::factory('admin/menu.php')->navBar(); _e('Welcome'); ?>, <a href="<?php $options->adminUrl('profile.php'); ?>" class="author important"><?php $user->screenName(); ?></a>
            <a class="exit" href="<?php $options->logoutUrl(); ?>" title="<?php _e('Logout'); ?>"><?php _e('Logout'); ?></a></p>
</div>
