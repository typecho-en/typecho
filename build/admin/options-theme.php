<?php
include 'common.php';
include 'header.php';
include 'menu.php';
?>

<div class="main">
    <div class="body body-950">
        <?php include 'page-title.php'; ?>
        <div class="container typecho-page-main">
            <ul class="typecho-option-tabs">
                <li><a href="<?php $options->adminUrl('themes.php'); ?>"><?php _e('You can use the appearance'); ?></a></li>
                <li><a href="<?php $options->adminUrl('theme-editor.php'); ?>"><?php _e('Edit the current theme'); ?></a></li>
                <li class="current"><a href="<?php $options->adminUrl('options-theme.php'); ?>"><?php _e('Themes settings'); ?></a></li>
            </ul>
            <div class="column-22 start-02">
                <?php Typecho_Widget::widget('Widget_Themes_Config')->config()->render(); ?>
            </div>
        </div>
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
include 'footer.php';
?>
