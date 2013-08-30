<?php
include 'common.php';
include 'header.php';
include 'menu.php';
?>

<div class="main">
    <div class="body body-950">
        <?php include 'page-title.php'; ?>
        <div class="container typecho-page-main">
            <div class="column-22 start-02">
                <div class="message notice typecho-radius-topleft typecho-radius-topright typecho-radius-bottomleft typecho-radius-bottomright">
                    <form action="<?php echo Typecho_Router::url('do', array('action' => 'upgrade', 'widget' => 'Upgrade'), 
                    Typecho_Common::url('index.php', $options->siteUrl)); ?>" method="post">
                    <h6><?php _e('Detects new versions!'); ?></h6>
                    <blockquote>
                    <ul>
                        <li><?php _e('You have already updated the system programs, we also need to do some next steps to complete the upgrade'); ?></li>
                        <li><?php _e('This program will upgrade from <strong>%s</strong> to <strong>%s</strong> of your system', $options->version, Typecho_Common::VERSION); ?></li>
                        <li><strong><?php _e('Upgrade is strongly recommended that you back up your data before'); ?></strong></li>
                    </ul>
                    </blockquote>
                    <br />
                    <p><button type="submit"><?php _e('Completing the upgrade &raquo;'); ?></button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
include 'footer.php';
?>
