<?php
include 'common.php';
include 'header.php';
include 'menu.php';

$stat = Typecho_Widget::widget('Widget_Stat');
?>
<div class="main">
    <div class="body body-950">
        <?php include 'page-title.php'; ?>
        <div class="container typecho-page-main">
            <div class="column-06 typecho-dashboard-nav suffix">
                <h3 class="intro"><?php _e('Welcome to Typecho, You can use the following link to start the journey to your Blog:'); ?></h3>
            
                <div class="intro-link">
                    <ul>
                        <li><a href="<?php $options->adminUrl('profile.php'); ?>"><?php _e('Update my information'); ?></a></li>
                        <?php if($user->pass('contributor', true)): ?>
                        <li><a href="<?php $options->adminUrl('write-post.php'); ?>"><?php _e('Write a new article'); ?></a></li>
                        <?php if($user->pass('editor', true) && 'on' == $request->get('__typecho_all_comments') && $stat->waitingCommentsNum > 0): ?> 
                            <li><a href="<?php $options->adminUrl('manage-comments.php?status=waiting'); ?>"><?php _e('Comments awaiting approval'); ?></a>
                            <span class="balloon"><?php $stat->waitingCommentsNum(); ?></span>
                            </li>
                        <?php elseif($stat->myWaitingCommentsNum > 0): ?>
                            <li><a href="<?php $options->adminUrl('manage-comments.php?status=waiting'); ?>"><?php _e('Comments awaiting approval'); ?></a>
                            <span class="balloon"><?php $stat->myWaitingCommentsNum(); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($user->pass('editor', true) && 'on' == $request->get('__typecho_all_comments') && $stat->spamCommentsNum > 0): ?> 
                            <li><a href="<?php $options->adminUrl('manage-comments.php?status=spam'); ?>"><?php _e('Spam comments'); ?></a>
                            <span class="balloon"><?php $stat->spamCommentsNum(); ?></span>
                            </li>
                        <?php elseif($stat->mySpamCommentsNum > 0): ?>
                            <li><a href="<?php $options->adminUrl('manage-comments.php?status=spam'); ?>"><?php _e('Spam comments'); ?></a>
                            <span class="balloon"><?php $stat->mySpamCommentsNum(); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($user->pass('editor', true)): ?>
                        <li><a href="<?php $options->adminUrl('write-page.php'); ?>"><?php _e('Create a new page'); ?></a></li>
                        <?php if($user->pass('administrator', true)): ?>
                        <li><a href="<?php $options->adminUrl('themes.php'); ?>"><?php _e('Change my theme'); ?></a></li>
                        <li><a href="<?php $options->adminUrl('options-general.php'); ?>"><?php _e('Modifying system settings'); ?></a></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            
                <h3><?php _e('Statistics'); ?></h3>
                <div class="status">
                    <p><?php _e('There are <em>%s</em> review Blog, there are <em>%s</em> comments about you in <em>%s</em> categories that have been set up.', 
                    $stat->myPublishedPostsNum, $stat->myPublishedCommentsNum, $stat->categoriesNum); ?></p>
                    
                    <p><?php 
                    if ($user->logged > 0) {
                        _e('Last logon: %s', Typecho_I18n::dateWord($user->logged  + $options->timezone, $options->gmtTime + $options->timezone));
                    }
                    ?></p>
                </div>
            </div>

            <div class="column-12 typecho-dashboard-main">
                <div class="section">
                    <h4><?php _e('Recently published articles'); ?></h4>
                    <?php Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=5')->to($posts); ?>
                    <ul>
                    <?php if($posts->have()): ?>
                    <?php while($posts->next()): ?>
                        <li><a href="<?php $posts->permalink(); ?>" class="title"><?php $posts->title(); ?></a> <?php _e('Posted on'); ?>
                        <?php $posts->category(', '); ?> - <span class="date"><?php $posts->dateWord(); ?></span></li>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <li><em><?php _e('Currently there are no articles'); ?></em></li>
                    <?php endif; ?>
                    </ul>
                </div>
            	<div class="section">
                    <h4><?php _e('Reply to the latest available'); ?></h4>
                    <ul>
                        <?php Typecho_Widget::widget('Widget_Comments_Recent', 'pageSize=5')->to($comments); ?>
                        <?php if($comments->have()): ?>
                        <?php while($comments->next()): ?>
                        <li><?php $comments->author(true); ?> <?php _e('Posted on'); ?> <a href="<?php $comments->permalink(); ?>" class="title"><?php $comments->title(); ?></a> - <span class="date"><?php $comments->dateWord(); ?></span></li>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <li><em><?php _e('Currently there are no reply'); ?></em></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="column-06 typecho-dashboard-nav prefix">
                <?php $version = Typecho_Cookie::get('__typecho_check_version'); ?>
                <?php if ($version && $version['available']): ?>
                <div class="update-check typecho-radius-topleft typecho-radius-topright typecho-radius-bottomleft typecho-radius-bottomright">
                    <p class="current"><?php _e('The version that you are currently using is'); ?> <em><?php echo $version['current']; ?></em></p>
                    <p class="latest">
                    <a href="<?php echo $version['link']; ?>"><?php _e('The latest official version is'); ?> <em><?php echo $version['latest']; ?></em></a>
                    </p>
                </div>
                <?php endif; ?>
                <h3><?php _e('Official sources'); ?></h3>
                <?php $feed = Typecho_Cookie::get('__typecho_feed'); ?>
                <div id="typecho-message" class="intro-link">
                    <ul>
                        <?php if (empty($feed)): ?>
                        <li><?php _e('Reading...'); ?></li>
                        <?php else: ?>
                        <?php $feed = Typecho_Json::decode($feed);
                        foreach ($feed as $item): ?>
                        <?php $item = (array) $item; ?>
                        <li><a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a> - <span class="date"><?php echo $item['date']; ?></span></li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
?>

<script type="text/javascript">
    (function () {
        window.addEvent('domready', function() {
            <?php if (!Typecho_Cookie::get('__typecho_feed')): ?>
            var _feedRequest = new Request.JSON({url: '<?php $options->index('/action/ajax'); ?>'}).send("do=feed");
            _feedRequest.addEvent('onSuccess', function (responseJSON) {
                $(document).getElement('#typecho-message ul li').destroy();
                
                if (responseJSON) {
                    responseJSON.each(function (item) {
                        var _li = document.createElement('li');
                        $(_li).set('html', '<a target="_blank" href="' + item.link + '">' + item.title + '</a> - <span class="date">' + item.date + '</span>');
                        var _ul = $(document).getElement('#typecho-message ul');
                        _ul.appendChild(_li);
                    });
                }
            });
            <?php endif; ?>
            
            <?php if ($user->pass('editor', true) && !Typecho_Cookie::get('__typecho_check_version')): ?>
            var _checkVersionRequest = new Request.JSON({url: '<?php $options->index('/action/ajax'); ?>'}).send("do=checkVersion");
            _checkVersionRequest.addEvent('onSuccess', function (responseJSON) {
                if (responseJSON && responseJSON.available) {
                    var _div = document.createElement('div', {
                        'class' : 'update-check typecho-radius-topleft typecho-radius-topright typecho-radius-bottomleft typecho-radius-bottomright',
                        'html'  : '<p class="current"><?php _e('The version that you are currently using is'); ?> <em>' + responseJSON.current + '</em></p>' +
                        '<p class="latest"><a target="_blank" href="' + responseJSON.link + '"><?php _e('The latest official version is'); ?> <em>' + responseJSON.latest + '</em></a></p>'
                    });
                    
                    $(_div).fade('hide');
                    $(document).getElement('.start-19').insertBefore(_div, $(document).getElement('.start-19 h3'));
                    $(_div).fade('in');
                }
            });
            <?php endif; ?>
        });
    })();
</script>
<?php include 'footer.php'; ?>
