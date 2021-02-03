<?php

function custom_dashboard_help() {
echo '
<p>
<ol><li>主题安装后，会在WP后台的左侧工具条上增加【<a href=/wp-admin/admin.php?page=options-framework>主题选项</a>】设置，这是主题的核心设置，请知悉！</li>
<li>主题安装好第一件事不是去设置主题选项，而是创建好你们的<a href=/wp-admin/edit-tags.php?taxonomy=category>分类</a>和<a href=/wp-admin/edit.php?post_type=page>页面</a>！（已有分类和页面的老站除外）。</li>
<li>在<a href=/wp-admin/admin.php?page=options-framework>主题选项</a>里选择调用分类时，没有显示你的分类名？那是因为该分类下无任何文章，写一篇<a href=/wp-admin/post-new.php>测试文章</a>到该分类下，即可在主题选项出现该分类！</li>
<li>通过<a href=/wp-admin/nav-menus.php>菜单</a>的<a href=/wp-admin/nav-menus.php?action=edit&menu=0>创建</a>功能可以创建出很多的菜单组，设置好菜单组，选择好菜单所要显示的位置！不会设置菜单，请自行百度：wordpress菜单设置</li>
<li>通过<a href=/wp-admin/widgets.php>小工具</a>可以设置网站侧栏展示的内容。</li>
<li>通过<a href=/wp-admin/options-permalink.php>固定连接</a>，通过这个设置，可以网站伪静态，具体教程请看<a href=http://www.suxing.me/wp-courses/563.html target=_blank>《WORDPRESS常用固定链接（伪静态）格式》</a></li>
<li>以上操作完后，请前往【<a href=/wp-admin/admin.php?page=options-framework>主题选项</a>】设置，按需设置，默认开启的可无需改变，保存即可！</li>
<li>第一次启动主题，请切记前往【<a href=/wp-admin/admin.php?page=options-framework>主题选项</a>】，保存下设置即可。</li>
<br>
<li>以上是主题使用方面最基础的操作，如需要修改主题里写死了的文字或链接，可以尝试下外观里的【<a href=/wp-admin/theme-editor.php>编辑</a>】 来进行修改！</li>

<li>最后，技术QQ：<a href=http://www.suxing.me/go/qq target=_blank>25679903</a>  （09:00-18:00在线） 请在这期间咨询我！</li></ol>

</p>';
}
function example_add_dashboard_widgets() {
    wp_add_dashboard_widget('custom_help_widget', '苏醒主题使用教程', 'custom_dashboard_help');
}
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );
