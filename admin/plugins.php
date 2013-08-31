<?php
include 'common.php';
include 'header.php';
include 'menu.php';
?>
<div class="main">
    <div class="body body-950">
        <?php include 'page-title.php'; ?>
        <div class="container typecho-page-main">
            <div class="column-24 typecho-list">
                <?php Typecho_Widget::widget('Widget_Plugins_List_Activated')->to($activatedPlugins); ?>
                <?php if ($activatedPlugins->have()): ?>
                <h6 class="typecho-list-table-title"><?php _e('Activate the plugin'); ?></h6>
                <table class="typecho-list-table">
                    <colgroup>
                        <col width="10"/>
                        <col width="200"/>
                        <col width="360"/>
                        <col width="90"/>
                        <col width="105"/>
                        <col width="125"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="typecho-radius-topleft"> </th>
                            <th><?php _e('Name'); ?></th>
                            <th><?php _e('Description'); ?></th>
                            <th><?php _e('Version'); ?></th>
                            <th><?php _e('Author'); ?></th>
                            <th class="typecho-radius-topright"><?php _e('Operation'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($activatedPlugins->next()): ?>
                        <tr<?php $activatedPlugins->alt(' class="even"', ''); ?> id="plugin-<?php $activatedPlugins->name(); ?>">
                            <td></td>
                            <td><?php $activatedPlugins->title(); ?>
                            <?php if (!$activatedPlugins->dependence): ?>
                            <img src="<?php $options->adminUrl('images/notice.gif'); ?>" title="<?php _e('%s Version typecho cannot work properly', $activatedPlugins->title); ?>" alt="<?php _e('%s Version typecho cannot work properly', $activatedPlugins->title); ?>" class="tiny" />
                            <?php endif; ?>
                            </td>
                            <td><?php $activatedPlugins->description(); ?></td>
                            <td><?php $activatedPlugins->version(); ?></td>
                            <td><?php echo empty($activatedPlugins->homepage) ? $activatedPlugins->author : '<a href="' . $activatedPlugins->homepage
                            . '">' . $activatedPlugins->author . '</a>'; ?></td>
                            <td>
                                <?php if ($activatedPlugins->activate || $activatedPlugins->deactivate || $activatedPlugins->config || $activatedPlugins->personalConfig): ?>
                                    <?php if ($activatedPlugins->activated): ?>
                                        <?php if ($activatedPlugins->config): ?>
                                            <a href="<?php $options->adminUrl('options-plugin.php?config=' . $activatedPlugins->name); ?>"><?php _e('Settings'); ?></a> 
                                            | 
                                        <?php endif; ?>
                                        <a lang="<?php _e('Are you sure you want to disable the plug-in %s ?', $activatedPlugins->name); ?>" href="<?php $options->index('/action/plugins-edit?deactivate=' . $activatedPlugins->name); ?>"><?php _e('Disable'); ?></a>
                                    <?php else: ?>
                                        <a href="<?php $options->index('/action/plugins-edit?activate=' . $activatedPlugins->name); ?>"><?php _e('Activation'); ?></a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="important"><?php _e('Plug and Play'); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        
                        <?php if (!empty($activatedPlugins->activatedPlugins)): ?>
                        <?php foreach ($activatedPlugins->activatedPlugins as $key => $val): ?>
                        <tr>
                        <td></td>
                        <td><?php echo $key; ?></td>
                        <td colspan="3"><span class="warning"><?php _e('This plug-in files have been damaged or is unsafe to remove, we strongly recommend you disable it'); ?></span></td>
                        <td><a lang="<?php _e('Are you sure you want to disable plug-in %s ?', $key); ?>" href="<?php $options->index('/action/plugins-edit?deactivate=' . $key); ?>"><?php _e('Disable'); ?></a></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        
                    </tbody>
                </table>
                <?php endif; ?>
                
                <?php Typecho_Widget::widget('Widget_Plugins_List_Deactivated')->to($deactivatedPlugins); ?>
                <?php if ($deactivatedPlugins->have() || !$activatedPlugins->have()): ?>
                <h6 class="typecho-list-table-title"><?php _e('Disable plugins'); ?></h6>
                <table class="typecho-list-table deactivate">
                    <colgroup>
                        <col width="10"/>
                        <col width="200"/>
                        <col width="360"/>
                        <col width="90"/>
                        <col width="105"/>
                        <col width="125"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="typecho-radius-topleft"> </th>
                            <th><?php _e('Name'); ?></th>
                            <th><?php _e('Description'); ?></th>
                            <th><?php _e('Version'); ?></th>
                            <th><?php _e('Author'); ?></th>
                            <th class="typecho-radius-topright"><?php _e('Operation'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($deactivatedPlugins->have()): ?>
                        <?php while ($deactivatedPlugins->next()): ?>
                        <tr<?php $deactivatedPlugins->alt(' class="even"', ''); ?> id="plugin-<?php $deactivatedPlugins->name(); ?>">
                            <td></td>
                            <td><?php $deactivatedPlugins->title(); ?></td>
                            <td><?php $deactivatedPlugins->description(); ?></td>
                            <td><?php $deactivatedPlugins->version(); ?></td>
                            <td><?php echo empty($deactivatedPlugins->homepage) ? $deactivatedPlugins->author : '<a href="' . $deactivatedPlugins->homepage
                            . '">' . $deactivatedPlugins->author . '</a>'; ?></td>
                            <td>
                                <?php if ($deactivatedPlugins->activate || $deactivatedPlugins->deactivate || $deactivatedPlugins->config || $deactivatedPlugins->personalConfig): ?>
                                    <?php if ($deactivatedPlugins->activated): ?>
                                        <?php if ($deactivatedPlugins->config): ?>
                                            <a href="<?php $options->adminUrl('options-plugin.php?config=' . $deactivatedPlugins->name); ?>"><?php _e('Settings'); ?></a> 
                                            | 
                                        <?php endif; ?>
                                        <a href="<?php $options->index('/action/plugins-edit?deactivate=' . $deactivatedPlugins->name); ?>"><?php _e('Disable'); ?></a>
                                    <?php else: ?>
                                        <a href="<?php $options->index('/action/plugins-edit?activate=' . $deactivatedPlugins->name); ?>"><?php _e('Activation'); ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr class="even">
                        	<td colspan="6"><?php _e('Not installed plugins'); ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
