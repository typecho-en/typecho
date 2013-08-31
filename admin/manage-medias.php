<?php
include 'common.php';
include 'header.php';
include 'menu.php';

$stat = Typecho_Widget::widget('Widget_Stat');
?>

<?php Typecho_Widget::widget('Widget_Contents_Attachment_Admin')->to($attachments); ?>
<div class="main">
    <div class="body body-950">
        <?php include 'page-title.php'; ?>
        <div class="container typecho-page-main">
            <div class="column-24 start-01">
                
                <div class="typecho-list-operate">
                <form method="get">
                    <p class="operate"><?php _e('Operation'); ?>: 
                        <span class="operate-button typecho-table-select-all"><?php _e('Select all'); ?></span>, 
                        <span class="operate-button typecho-table-select-none"><?php _e('Do not select all'); ?></span>&nbsp;&nbsp;&nbsp;
                        <?php _e('Checked items'); ?>: 
                        <span rel="delete" lang="<?php _e('Are you sure you want to delete these attachments?'); ?>" class="operate-button operate-delete typecho-table-select-submit"><?php _e('Delete'); ?></span>
                    </p>
                    <p class="search">
                    <?php if ('' != $request->keywords): ?>
                    <a href="<?php $options->adminUrl('manage-medias.php'); ?>"><?php _e('&laquo; Remove filter'); ?></a>
                    <?php endif; ?>
                    <input type="text" value="<?php '' != $request->keywords ? print(htmlspecialchars($request->keywords)) : _e('Please enter a keyword'); ?>"<?php if ('' == $request->keywords): ?> onclick="value='';name='keywords';" <?php else: ?> name="keywords"<?php endif; ?>/>
                    <button type="submit"><?php _e('Filter'); ?></button>
                    </p>
                </form>
                </div>
            
                <form method="post" name="manage_medias" class="operate-form" action="<?php $options->index('/action/contents-attachment-edit'); ?>">
                <table class="typecho-list-table draggable">
                    <colgroup>
                        <col width="25"/>
                        <col width="50"/>
                        <col width="20"/>
                        <col width="275"/>
                        <col width="30"/>
                        <col width="120"/>
                        <col width="220"/>
                        <col width="150"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="typecho-radius-topleft"> </th>
                            <th> </th>
                            <th> </th>
                            <th><?php _e('File name'); ?></th>
                            <th> </th>
                            <th><?php _e('The uploader'); ?></th>
                            <th><?php _e('Belongs to the article'); ?></th>
                            <th class="typecho-radius-topright"><?php _e('Release date'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php if($attachments->have()): ?>
                        <?php while($attachments->next()): ?>
                        <?php $mime = Typecho_Common::mimeIconType($attachments->attachment->mime); ?>
                        <tr<?php $attachments->alt(' class="even"', ''); ?> id="<?php $attachments->theId(); ?>">
                            <td><input type="checkbox" value="<?php $attachments->cid(); ?>" name="cid[]"/></td>
                            <td><a href="<?php $options->adminUrl('manage-comments.php?cid=' . $attachments->cid); ?>" class="balloon-button right size-<?php echo Typecho_Common::splitByCount($attachments->commentsNum, 1, 10, 20, 50, 100); ?>"><?php $attachments->commentsNum(); ?></a></td>
                            <td><span class="typecho-mime typecho-mime-<?php echo $mime; ?>"></span></td>
                            <td><a href="<?php $options->adminUrl('media.php?cid=' . $attachments->cid); ?>"><?php $attachments->title(); ?></a></td>
                            <td>
                            <a class="right hidden-by-mouse" href="<?php $attachments->permalink(); ?>"><img src="<?php $options->adminUrl('images/view.gif'); ?>" title="<?php _e('Browse %s', $attachments->title); ?>" width="16" height="16" alt="view" /></a>
                            </td>
                            <td><?php $attachments->author(); ?></td>
                            <td>
                            <?php if ($attachments->parentPost->cid): ?>
                            <a href="<?php $options->adminUrl('write-' . $attachments->parentPost->type . '.php?cid=' . $attachments->parentPost->cid); ?>"><?php $attachments->parentPost->title(); ?></a>
                            <?php else: ?>
                            <span class="description"><?php _e('Not archived'); ?></span>
                            <?php endif; ?>
                            </td>
                            <td><?php $attachments->dateWord(); ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr class="even">
                        	<td colspan="8"><h6 class="typecho-list-table-title"><?php _e('No attachments'); ?></h6></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <input type="hidden" name="do" value="delete" />
                </form>
                
                <?php if($attachments->have()): ?>
            <div class="typecho-pager">
                <div class="typecho-pager-content">
                    <ul>
                        <?php $attachments->pageNav(); ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
include 'footer.php';
?>
