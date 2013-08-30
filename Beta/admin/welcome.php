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
                <div class="message success typecho-radius-topleft typecho-radius-topright typecho-radius-bottomleft typecho-radius-bottomright">
                    <form action="<?php $options->adminUrl(); ?>" method="get">
                    <h6><?php _e('You are welcome to use "%s" Management background!', $options->title); ?></h6>
                    <blockquote>
                    <ul>
                        <li><strong><?php _e('Quick navigation'); ?></strong></li>
                        <li><strong>1.</strong> <a class="operate-delete" href="<?php $options->adminUrl('profile.php#change-password'); ?>"><?php _e('Strongly recommended to change your default password'); ?></a></li>
                        <?php if($user->pass('contributor', true)): ?>
                        <li><strong>2.</strong> <a href="<?php $options->adminUrl('write-post.php'); ?>"><?php _e('Write first log'); ?></a></li>
                        <li><strong>3.</strong> <a href="<?php $options->siteUrl(); ?>"><?php _e('View my site'); ?></a></li>
                        <?php else: ?>
                        <li><strong>2.</strong> <a href="<?php $options->siteUrl(); ?>"><?php _e('View my site'); ?></a></li>
                        <?php endif; ?>
                    </ul>
                    </blockquote>
                    <br />
                    <p><button type="submit"><?php _e('Let me just start using it &raquo;'); ?></button></p>
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
