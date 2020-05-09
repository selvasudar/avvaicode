jQuery(document).ready(function() {
  emg_shortcode_ready();
});
jQuery(window).resize(function() {
  emg_shortcode_ready();
});

function emg_shortcode_ready() {
  
  tinymce.create('tinymce.plugins.emg_mce', {
    init: function (ed, url) {
      var c = this;
      c.url = url;
      c.editor = ed;

      ed.addButton('emg_mce', {
        id:'emg_gut_shorcode',
		classes: 'emg_gut_shorcode_btn',
		text: 'Insert Gallery',
        title:'Insert Photo Gallery',
        cmd:'mceemg_mce',
        image: url + '/img/emg_scmanager_icon.png'
      });
    },
  });
  tinymce.PluginManager.add('emg_mce', tinymce.plugins.emg_mce);
  
}