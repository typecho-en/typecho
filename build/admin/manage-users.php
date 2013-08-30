<?php
include 'common.php';
include 'header.php';
include 'menu.php';
?>
<div class="main">
    <div class="body body-950">
        <?php include 'page-title.php'; ?>
        <div class="container typecho-page-main">
            <div class="column-24 start-01 typecho-list">
                <div class="typecho-list-operate">
                <form method="get">
                    <p class="operate">
                    <?php _e('Operation'); ?>: 
                    <span class="operate-button typecho-table-select-all"><?php _e('Select all'); ?></span>, 
                    <span class="operate-button typecho-table-select-none"><?php _e('Do not select all'); ?></span>,&nbsp;&nbsp;&nbsp;
                    <?php _e('Checked items'); ?>: 
                    <span rel="delete" lang="<?php _e('Are you sure you want to delete the users?'); ?>" class="operate-button operate-delete typecho-table-select-submit"><?php _e('Delete'); ?></span>
                    </p>
                    <p class="search">
                    <?php if ('' != $request->keywords): ?>
                    <a href="<?php $options->adminUrl('manage-users.php'); ?>"><?php _e('&laquo; Remove filter'); ?></a>
                    <?php endif; ?>
                    <input type="text" value="<?php '' != $request->keywords ? print(htmlspecialchars($request->keywords)) : _e('Please enter a keyword'); ?>"<?php if ('' == $request->keywords): ?> onclick="value='';name='keywords';" <?php else: ?> name="keywords"<?php endif; ?>/>
                    <button type="submit"><?php _e('Filter'); ?></button>
                    </p>
                </form>
                </div>
            
                <form method="post" name="manage_users" class="operate-form" action="<?php $options->index('/action/users-edit'); ?>">
                <table class="typecho-list-table">
                    <colgroup>
                        <col width="25"/>
                        <col width="150"/>
                        <col width="150"/>
                        <col width="30"/>
                        <col width="300"/>
                        <col width="165"/>
                        <col width="70"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="typecho-radius-topleft"> </th>
                            <th><?php _e('User name'); ?></th>
                            <th><?php _e('Nicknames'); ?></th>
                            <th> </th>
                            <th><?php _e('E-mail'); ?></th>
                            <th><?php _e('User group'); ?></th>
                            <th class="typecho-radius-topright"><?php _e('Articles'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php Typecho_Widget::widget('Widget_Users_Admin')->to($users); ?>
                        <?php while($users->next()): ?>
                        <tr<?php $users->alt(' class="even"', ''); ?> id="user-<?php $users->uid(); ?>">
                            <td><input type="checkbox" value="<?php $users->uid(); ?>" name="uid[]"/></td>
                            <td><a href="<?php $options->adminUrl('user.php?uid=' . $users->uid); ?>"><?php $users->name(); ?></a></td>
                            <td><?php $users->screenName(); ?></td>
                            <td>
                            <a class="right hidden-by-mouse" href="<?php $users->permalink(); ?>"><img src="<?php $options->adminUrl('images/view.gif'); ?>" title="<?php _e('Browse %s', $users->screenName); ?>" width="16" height="16" alt="view" /></a>
                            </td>
                            <td><?php if($users->mail): ?><a href="mailto:<?php $users->mail(); ?>"><?php $users->mail(); ?></a><?php else: _e('No'); endif; ?></td>
                            <td><?php switch ($users->group) {
                                case 'administrator':
                                    _e('Admin');
                                    break;
                                case 'editor':
                                    _e('Editor');
                                    break;
                                case 'contributor':
                                    _e('Contributors');
                                    break;
                                case 'subscriber':
                                    _e('Followers');
                                    break;
                                case 'visitor':
                                    _e('Visitors');
                                    break;
                                default:
                                    break;
                            } ?></td>
                            <td><a href="<?php $options->adminUrl('manage-posts.php?uid=' . $users->uid); ?>" class="balloon-button left size-<?php echo Typecho_Common::splitByCount($users->postsNum, 1, 10, 20, 50, 100); ?>"><?php $users->postsNum(); ?></a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <input type="hidden" name="do" value="delete" />
                </form>
                
            <?php if($users->have()): ?>
            <div class="typecho-pager">
                <div class="typecho-pager-content">
                    <ul>
                        <?php $users->pageNav(); ?>
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
