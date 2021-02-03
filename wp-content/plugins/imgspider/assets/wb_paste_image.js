
(function() {

    tinymce.PluginManager.add('wb_paste_image', function (editor) {

        //console.log('step-1');

        return {
            init_ifm : function(editor){
                //console.log('step-4');
                jQuery("html").find("iframe").contents().find("body").ready().pasteImageReader(function(results) {
                    //console.log('step-5');
                    var param = {
                        action: "wb_scrapy_image",
                        'do':'save_paste_image',
                        image: results.dataURL,
                        filename: results.filename,
                        name: results.name,
                        post_title:jQuery('#title').val(),
                        post_id:jQuery('#post_ID').val()
                    };
                    jQuery.ajax({
                        url: ajaxurl,
                        type: "POST",
                        data: param,
                        dataType:'json',
                        success: function(ret) {
                            //console.log(ret);
                            if(ret.length > 0){
                                editor.execCommand("mceInsertContent", false, ret[0]);
                            }else{
                                alert('保存图片失败');
                            }
                        },error:function(){

                        }
                    })
                })
            },
            init : function(editor, url) {

                //console.log('step-2');
                var vm = this;
                setTimeout(function(){
                    //console.log('step-3');
                    vm.init_ifm(editor);
                    }, 60);


            },
            createControl : function(n, cm) {
                return null;
            },
            getInfo : function() {
                return null;
            }
        }
    });


   /* var this_tiny = null;
    tinymce.create("tinymce.plugins.wb_paste_image", {
        ed: null,
        init: function(ed, url) {
            this.ed = ed;
            this_tiny = this;
            setTimeout(this._hook, 1);

        },
        _paste: function(content) {
            return content
        },
        _hook: function() {
            var that = this;

        }
    });
    tinymce.PluginManager.add("wb_paste_image", tinymce.plugins.wb_paste_image)*/
})();