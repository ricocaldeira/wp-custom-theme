(function() {
    tinymce.PluginManager.add('cshero_quote_btn', function( editor, url ) {
        editor.addButton( 'cshero_quote_btn', {
            text: 'Quote',
            icon: false,
            type: 'menubutton',
            menu: [
                {
                    text: 'Blockquote',
                    value: 'cms-blockquote',
                    onclick: function() {
                        editor.insertContent('<blockquote class="'+this.value()+'">'+tinyMCE.activeEditor.selection.getContent()+'<blockquote>');
                    }
                },
                {
                    text: 'Blockquote Style 2',
                    value: 'cms-blockquote-2',
                    onclick: function() {
                        editor.insertContent('<blockquote class="'+this.value()+'">'+tinyMCE.activeEditor.selection.getContent()+'<blockquote>');
                    }
                },
                {
                    text: 'Blockquote Style 3',
                    value: 'cms-blockquote-4',
                    onclick: function() {
                        editor.insertContent('<blockquote class="'+this.value()+'"><span class="quote-before">“</span>'+tinyMCE.activeEditor.selection.getContent()+'<span class="quote-after">”</span><blockquote>');
                    }
                },
                {
                    text: 'Blockquote Background',
                    value: 'cms-blockquote-3',
                    onclick: function() {
                        editor.insertContent('<blockquote class="'+this.value()+'">'+tinyMCE.activeEditor.selection.getContent()+'<blockquote>');
                    }
                },
           ]
        });
    });
})();