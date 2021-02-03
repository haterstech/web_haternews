(function($) {
 //侧栏随动
    var elments = {
        sidebar: $('.sidebar'),
        footer: $('#footer')
    }
	jui.roll = jui.roll.split(' ')
    if( elments.sidebar && jui.roll.length ){

    	var h1 = 68, h2 = 90
        var rollFirst = elments.sidebar.find('.widget:eq('+(Number(jui.roll[0])-1)+')')
        var sheight = rollFirst.height()
        rollFirst.on('affix-top.bs.affix', function(){
            rollFirst.css({top: 0}) 
            sheight = rollFirst.height()

            for (var i = 1; i < jui.roll.length; i++) {
                var item = Number(jui.roll[i])-1
                var current = elments.sidebar.find('.widget:eq('+item+')')
                current.removeClass('affix').css({top: 0})
            };
        })

        rollFirst.on('affix.bs.affix', function(){
            rollFirst.css({top: h1}) 

            for (var i = 1; i < jui.roll.length; i++) {
                var item = Number(jui.roll[i])-1
                var current = elments.sidebar.find('.widget:eq('+item+')')
                current.addClass('affix').css({top: sheight+h2})
                sheight += current.height() + 20
            };
        })

        rollFirst.affix({
            offset: {
                top: elments.sidebar.height(),
                bottom: (elments.footer.height()||0) + 10
            }
        })
    }


})(jQuery)


