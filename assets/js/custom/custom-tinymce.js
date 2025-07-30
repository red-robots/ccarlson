(function() {
  tinymce.PluginManager.add( 'highlightblock', function( editor, url ) {
    var parts = url.split('assets');
    var themeURL = parts[0];
    
    // Add Button to Visual Editor Toolbar
    editor.addButton('custom_class', {
      title: 'Highlight Text',
      cmd: 'custom_class',
      image: themeURL + 'images/highlight.png',
    });

    // Add Command when Button Clicked
    editor.addCommand('custom_class', function() {
        var selected_text = editor.selection.getContent();
        if ( selected_text.length === 0 ) {
            alert( 'Please select some text.' );
            return;
        }
        var open_column = '<div class="highlightBox">';
        var close_column = '</div>';
        var return_text = '';
        return_text = open_column + selected_text + close_column;
        editor.execCommand('mceReplaceContent', false, return_text);
        return;
    });
  });

  tinymce.PluginManager.add( 'ctabutton', function( editor, url ) {
      //console.log(url);
      var parts = url.split('assets');
      var themeURL = parts[0];
      
      // Add Button to Visual Editor Toolbar
      editor.addButton('edbutton1', {
          title: 'Custom Button',
          cmd: 'edbutton1',
          image: themeURL + 'images/custom-button.png',
      });

      // Add Command when Button Clicked
      editor.addCommand('edbutton1', function() {
        var selected_text = editor.selection.getContent();
        if ( selected_text.length === 0 ) {
            alert( 'Please select some text.' );
            return;
        }
        var open_column = '<span class="custom-button-element"><a data-mce-href="#" href="#"  data-mce-selected="inline-boundary" class="button-element button">';
        var close_column = '</a></span>';
        var return_text = '';
        return_text = open_column + selected_text + close_column;
        editor.execCommand('mceReplaceContent', false, return_text);
        return;
      });
  });

})();