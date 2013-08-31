<?php
include 'common.php';
include 'header.php';
include 'menu.php';
Typecho_Widget::widget('Widget_Contents_Page_Edit')->to($page);
?>
<div class="main">
    <div class="body body-950">
        <?php include 'page-title.php'; ?>
        <div class="container typecho-page-main typecho-post-option typecho-post-area">
            <form action="<?php $options->index('/action/contents-page-edit'); ?>" method="post" name="write_page">
                <div class="column-18 suffix">
                    <div class="column-18">
                        <label for="title" class="typecho-label"><?php _e('Title'); ?>
                        <?php if ($page->draft && $page->draft['cid'] != $page->cid): ?>
                        <?php $pageModifyDate = new Typecho_Date($page->draft['modified']); ?>
                        <cite><?php _e('Currently being edited is stored in %s drafts, you can <a href="%s">delete it</a>', $pageModifyDate->word(), 
                        Typecho_Common::url('/action/contents-page-edit?do=deleteDraft&cid=' . $page->cid, $options->index)); ?></cite>
                        <?php endif; ?>
                        </label>
                        <p class="title"><input type="text" id="title" name="title" value="<?php echo htmlspecialchars($page->title); ?>" class="text title" /></p>
                        <label for="text" class="typecho-label"><?php _e('Content'); ?><cite id="auto-save-message"></cite></label>
                        <p><textarea style="height: <?php $options->editorSize(); ?>px" autocomplete="off" id="text" name="text"><?php echo htmlspecialchars($page->text); ?></textarea></p>
                        <?php Typecho_Plugin::factory('admin/write-page.php')->content($page); ?>
                        <p class="submit">
                            <span class="left">
                                <span class="advance close"><?php _e('Expand the Advanced Options'); ?></span>
                                <span class="attach"><?php _e('Expand Accessories'); ?></span>
                            </span>
                            <span class="right">
                                <input type="hidden" name="cid" value="<?php $page->cid(); ?>" />
                                <input type="hidden" name="do" value="publish" />
                                <button type="button" id="btn-save"><?php _e('Save Draft'); ?></button>
                                <button type="button" id="btn-submit"><?php _e('Publish Page &raquo;'); ?></button>
                            </span>
                        </p>
                    </div>
                        
                    <ul id="advance-panel" class="typecho-post-option column-18">
                        <li class="column-18">
                            <div class="column-12">
                                <label for="order" class="typecho-label"><?php _e('Page order'); ?></label>
                                <p><input type="text" id="order" name="order" value="<?php $page->order(); ?>" class="mini" /></p>
                                <p class="description"><?php _e('For your custom pages set up after a sequence of values, making them arranged by this value from small to large'); ?></p>
                                <br />
                                <label for="template" class="typecho-label"><?php _e('Custom templates'); ?></label>
                                <p>
                                    <select name="template" id="template">
                                        <option value=""><?php _e('Do not choose'); ?></option>
                                        <?php $templates = $page->getTemplates(); foreach ($templates as $template => $name): ?>
                                        <option value="<?php echo $template; ?>"<?php if($template == $page->template): ?> selected="true"<?php endif; ?>><?php echo $name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                                <p class="description"><?php _e('If you select a custom template for this page, the system will follow the template file that you choose to show it'); ?></p>
                                <?php Typecho_Plugin::factory('admin/write-page.php')->advanceOptionLeft($page); ?>
                            </div>
                            <div class="column-06">
                                <label class="typecho-label"><?php _e('Permission control'); ?></label>
                                <ul>
                                    <li><input id="allowComment" name="allowComment" type="checkbox" value="1" <?php if($page->allow('comment')): ?>checked="true"<?php endif; ?> />
                                    <label for="allowComment"><?php _e('Allow comments'); ?></label></li>
                                    <li><input id="allowPing" name="allowPing" type="checkbox" value="1" <?php if($page->allow('ping')): ?>checked="true"<?php endif; ?> />
                                    <label for="allowPing"><?php _e('Allowed to be referenced'); ?></label></li>
                                    <li><input id="allowFeed" name="allowFeed" type="checkbox" value="1" <?php if($page->allow('feed')): ?>checked="true"<?php endif; ?> />
                                    <label for="allowFeed"><?php _e('Allow appears in the RSS'); ?></label></li>
                                    <?php Typecho_Plugin::factory('admin/write-page.php')->advanceOptionRight($page); ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <ul id="upload-panel" class="column-18">
                        <li class="column-18">
                            <?php include 'file-upload.php'; ?>
                        </li>
                    </ul>
                </div>
                <div class="column-06">
                    <ul class="typecho-post-option">
                        <li>
                            <label for="date" class="typecho-label"><?php _e('Date'); ?></label>
                            <p>
                                <select disabled class="typecho-date" name="month" id="month">
                                    <option value="1" <?php if (1 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('January'); ?></option>
                                    <option value="2" <?php if (2 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('February'); ?></option>
                                    <option value="3" <?php if (3 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('March'); ?></option>
                                    <option value="4" <?php if (4 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('April'); ?></option>
                                    <option value="5" <?php if (5 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('May'); ?></option>
                                    <option value="6" <?php if (6 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('June'); ?></option>
                                    <option value="7" <?php if (7 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('July'); ?></option>
                                    <option value="8" <?php if (8 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('August'); ?></option>
                                    <option value="9" <?php if (9 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('September'); ?></option>
                                    <option value="10" <?php if (10 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('October'); ?></option>
                                    <option value="11" <?php if (11 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('November'); ?></option>
                                    <option value="12" <?php if (12 == $page->date->format('n')): ?>selected="true"<?php endif; ?>><?php _e('December'); ?></option>
                                </select>
                                <input disabled class="typecho-date" size="4" maxlength="4" type="text" name="day" id="day" value="<?php $page->date('d'); ?>" />
                                ,
                                <input disabled class="typecho-date" size="4" maxlength="4" type="text" name="year" id="year" value="<?php $page->date('Y'); ?>" />
                                @
                                <input disabled class="typecho-date" size="2" maxlength="2" type="text" name="hour" id="hour" value="<?php $page->date('H'); ?>" />
                                :
                                <input disabled class="typecho-date" size="2" maxlength="2" type="text" name="min" id="min" value="<?php $page->date('i'); ?>" />
                            </p>
                            <p class="description"><?php _e('Please select a publishing date'); ?></p>
                        </li>
                        <li>
                            <label for="slug" class="typecho-label"><?php _e('Short name'); ?></label>
                            <p><input type="text" id="slug" name="slug" value="<?php $page->slug(); ?>" class="mini" /></p>
                            <p class="description"><?php _e('Customize the links for this blog will help search engine'); ?></p>
                        </li>
                        <?php Typecho_Plugin::factory('admin/write-page.php')->option($page); ?>
                        <?php if($page->have()): ?>
                        <?php $modified = new Typecho_Date($page->modified); ?>
                        <li>
                            <label class="typecho-label"><?php _e('This page was created by %s', $page->author->screenName); ?></label>
                            <p class="description"><?php _e('Last modified on %s', $modified->word()); ?></p>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
include 'write-js.php';

Typecho_Plugin::factory('admin/write-page.php')->trigger($plugged)->richEditor($page);
if (!$plugged) {
    include 'editor-js.php';
}
Typecho_Plugin::factory('admin/write-page.php')->bottom($page);
include 'file-upload-js.php';
include 'footer.php';
?>
