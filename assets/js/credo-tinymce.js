'use strict';

(function() {
    tinymce.create('tinymce.plugins.credo_plugin', {
        init: function(editor, url) {
            var assetsUrl = url.replace('/js', '/');
            editor.addCommand('credo_insert_shortcode', function() {

                var selected = tinymce.activeEditor.selection.getContent();
                var content = (selected) ? '[credo-pay-button]' + selected + '[/credo-pay-button]' : '[credo-pay-button]';
                tinymce.execCommand('mceInsertContent', false, content);

            });

            editor.addButton('credo_button', {
                title: 'Insert Credo payment shortcode',
                cmd: 'credo_insert_shortcode',
                image: assetsUrl + 'images/credo-icon.png',
            });
        },
    });

    tinymce.PluginManager.add('credo_button', tinymce.plugins.credo_plugin);

})();