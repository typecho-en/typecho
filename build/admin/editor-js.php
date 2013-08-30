<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<script type="text/javascript">
    var textEditor = new Typecho.textarea('#text', {
        autoSaveTime: 30,
        resizeAble: true,
        autoSave: <?php echo ($options->autoSave ? 'true' : 'false'); ?>,
        autoSaveMessageElement: 'auto-save-message',
        autoSaveLeaveMessage: '<?php _e('Your content has not yet been saved, navigate away from this page?'); ?>',
        resizeUrl: '<?php $options->index('/action/ajax'); ?>'
    });

    /** Both of these functions in the plug-in must implement */
    var insertImageToEditor = function (title, url, link, cid) {
        textEditor.setContent('<a href="' + link + '" title="' + title + '"><img src="' + url + '" alt="' + title + '" /></a>', '');
        new Fx.Scroll(window).toElement($(document).getElement('textarea#text'));
    };
    
    var insertLinkToEditor = function (title, url, link, cid) {
        textEditor.setContent('<a href="' + url + '" title="' + title + '">' + title + '</a>', '');
        new Fx.Scroll(window).toElement($(document).getElement('textarea#text'));
    };
</script>
