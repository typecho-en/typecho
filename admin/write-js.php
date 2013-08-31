<script type="text/javascript">
    (function () {
        window.addEvent('domready', function() {
        
            $(document).getElements('.typecho-date').each(function (item) {
                item.setProperty('name', '_' + item.getProperty('name'));
                item.addEvent('change', function () {

                    $(document).getElements('.typecho-date').each(function (_item) {
                        var name = _item.name;

                        if (0 == name.indexOf('_')) {
                            _item.setProperty('name', name.slice(1));
                        }
                    });
                    
                });
                
                item.removeProperty('disabled');
            });
        
            /** Binding button */
            $(document).getElement('span.advance').addEvent('click', function () {
                Typecho.toggle('#advance-panel', this,
                '<?php _e('Hide advanced options'); ?>', '<?php _e('Expand the advanced options'); ?>');
            });
            
            $(document).getElement('span.attach').addEvent('click', function () {
                Typecho.toggle('#upload-panel', this,
                '<?php _e('Collection accessories'); ?>', '<?php _e('Expand Accessories'); ?>');
            });
            
            $('btn-save').removeProperty('disabled');
            $('btn-submit').removeProperty('disabled');
            
            $('btn-save').addEvent('click', function (e) {
                this.getParent('span').addClass('loading');
                this.setProperty('disabled', true);
                $(document).getElement('input[name=do]').set('value', 'save');
                $(document).getElement('.typecho-post-area form').submit();
            });
            
            $('btn-submit').addEvent('click', function (e) {
                this.getParent('span').addClass('loading');
                this.setProperty('disabled', true);
                $(document).getElement('input[name=do]').set('value', 'publish');
                $(document).getElement('.typecho-post-area form').submit();
            });
        });
    })();
</script>
