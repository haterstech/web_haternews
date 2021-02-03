<?php
/**
 * This was contained in an addon until version 1.0.0 when it was rolled into
 * core.
 *
 * @package    WBOLT
 * @author     WBOLT
 * @since      1.2.1
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WBOLT
 */

$pd_title = 'IMGspider-图片蜘蛛';
$pd_version = IMGSPY_VERSION;
$pd_code = 'imgspider-setting';
$pd_index_url = 'https://www.wbolt.com/plugins/imgspider';
$pd_doc_url = 'https://www.wbolt.com/imgspider-plugin-documentation.html';

?>

<script>
    var _cnf = <?php echo json_encode($cnf); ?>;
    var _pd_code = '<?php echo $pd_code; ?>';
    var post_types = <?php echo json_encode($post_types);?>
</script>

<div style=" display:none;">
    <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
            <symbol id="sico-upload" viewBox="0 0 16 13">
                <path d="M9 8v3H7V8H4l4-4 4 4H9zm4-2.9V5a5 5 0 0 0-5-5 4.9 4.9 0 0 0-4.9 4.3A4.4 4.4 0 0 0 0 8.5C0 11 2 13 4.5 13H12a4 4 0 0 0 1-7.9z" fill="#666" fill-rule="evenodd"/>
            </symbol>
            <symbol id="sico-download" viewBox="0 0 16 16">
                <path d="M9 9V0H7v9H4l4 4 4-4z"/><path d="M15 16H1a1 1 0 0 1-1-1.1l1-8c0-.5.5-.9 1-.9h3v2H2.9L2 14H14L13 8H11V6h3c.5 0 1 .4 1 .9l1 8a1 1 0 0 1-1 1.1"/>
            </symbol>
            <symbol id="sico-wb-logo" viewBox="0 0 18 18">
                <title>sico-wb-logo</title>
                <path d="M7.264 10.8l-2.764-0.964c-0.101-0.036-0.172-0.131-0.172-0.243 0-0.053 0.016-0.103 0.044-0.144l-0.001 0.001 6.686-8.55c0.129-0.129 0-0.321-0.129-0.386-0.631-0.163-1.355-0.256-2.102-0.256-2.451 0-4.666 1.009-6.254 2.633l-0.002 0.002c-0.791 0.774-1.439 1.691-1.905 2.708l-0.023 0.057c-0.407 0.95-0.644 2.056-0.644 3.217 0 0.044 0 0.089 0.001 0.133l-0-0.007c0 1.221 0.257 2.314 0.643 3.407 0.872 1.906 2.324 3.42 4.128 4.348l0.051 0.024c0.129 0.064 0.257 0 0.321-0.129l2.25-5.593c0.064-0.129 0-0.257-0.129-0.321z"></path>
                <path d="M16.714 5.914c-0.841-1.851-2.249-3.322-4.001-4.22l-0.049-0.023c-0.040-0.027-0.090-0.043-0.143-0.043-0.112 0-0.206 0.071-0.242 0.17l-0.001 0.002-2.507 5.914c0 0.129 0 0.257 0.129 0.321l2.571 1.286c0.129 0.064 0.129 0.257 0 0.386l-5.979 7.264c-0.129 0.129 0 0.321 0.129 0.386 0.618 0.15 1.327 0.236 2.056 0.236 2.418 0 4.615-0.947 6.24-2.49l-0.004 0.004c0.771-0.771 1.414-1.671 1.929-2.7 0.45-1.029 0.643-2.121 0.643-3.279s-0.193-2.314-0.643-3.279z"></path>
            </symbol>
            <symbol id="sico-more" viewBox="0 0 16 16">
                <path d="M6 0H1C.4 0 0 .4 0 1v5c0 .6.4 1 1 1h5c.6 0 1-.4 1-1V1c0-.6-.4-1-1-1M15 0h-5c-.6 0-1 .4-1 1v5c0 .6.4 1 1 1h5c.6 0 1-.4 1-1V1c0-.6-.4-1-1-1M6 9H1c-.6 0-1 .4-1 1v5c0 .6.4 1 1 1h5c.6 0 1-.4 1-1v-5c0-.6-.4-1-1-1M15 9h-5c-.6 0-1 .4-1 1v5c0 .6.4 1 1 1h5c.6 0 1-.4 1-1v-5c0-.6-.4-1-1-1"/>
            </symbol>
            <symbol id="sico-plugins" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M16 3h-2V0h-2v3H8V0H6v3H4v2h1v2a5 5 0 0 0 4 4.9V14H2v-4H0v5c0 .6.4 1 1 1h9c.6 0 1-.4 1-1v-3.1A5 5 0 0 0 15 7V5h1V3z"/>
            </symbol>
            <symbol id="sico-doc" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 0H1C.4 0 0 .4 0 1v14c0 .6.4 1 1 1h14c.6 0 1-.4 1-1V1c0-.6-.4-1-1-1zm-1 2v9h-3c-.6 0-1 .4-1 1v1H6v-1c0-.6-.4-1-1-1H2V2h12z"/><path d="M4 4h8v2H4zM4 7h8v2H4z"/>
            </symbol>
            
            <symbol id="wbsico-donate" viewBox="0 0 9 18">
                <path fill-rule="evenodd" d="M5.63 8.1V4.61c.67.23 1.12.9 1.12 1.58S7.2 7.3 7.88 7.3 9 6.86 9 6.2a3.8 3.8 0 0 0-3.38-3.83V1.12C5.63.45 5.17 0 4.5 0S3.37.45 3.37 1.12v1.24A3.8 3.8 0 0 0 0 6.2C0 8.55 1.8 9.45 3.38 9.9v3.49c-.68-.23-1.13-.9-1.13-1.58S1.8 10.7 1.12 10.7 0 11.14 0 11.8a3.8 3.8 0 0 0 3.38 3.83v1.24c0 .67.45 1.12 1.12 1.12s1.13-.45 1.13-1.12v-1.24A3.88 3.88 0 0 0 9 11.8c0-2.36-1.8-3.26-3.38-3.7zM2.25 6.19c0-.79.45-1.35 1.13-1.58v2.93c-.8-.34-1.13-.68-1.13-1.35zm3.38 7.2v-2.93c.78.34 1.12.68 1.12 1.35 0 .79-.45 1.35-1.13 1.58z"></path>
            </symbol>
            <symbol id="wbsico-like" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.3 6H9V2c0-1.5-.8-2-2-2-.3 0-.6.2-.6.5L4 8v8h8.6c1.3 0 2.4-1 2.6-2.3l.8-4.6c.1-.8-.1-1.6-.6-2.1-.5-.7-1.3-1-2.1-1M0 8h2v8H0z"/>
            </symbol>
            <symbol id="wbsico-share" viewBox="0 0 14 16">
                <path fill-rule="evenodd" d="M11 6a3 3 0 1 0-3-2.4L5 5.6A3 3 0 0 0 3 5a3 3 0 0 0 0 6 3 3 0 0 0 1.9-.7l3.2 2-.1.7a3 3 0 1 0 3-3 3 3 0 0 0-1.9.7L6 8.7a3 3 0 0 0 0-1.3l3.2-2A3 3 0 0 0 11 6"/>
            </symbol>
            <symbol id="wbsico-time" viewBox="0 0 18 18">
                <path d="M9 15.75c-3.71 0-6.75-3.04-6.75-6.75S5.29 2.25 9 2.25 15.75 5.29 15.75 9 12.71 15.75 9 15.75zM9 0C4.05 0 0 4.05 0 9s4.05 9 9 9 9-4.05 9-9-4.05-9-9-9z"/>
                <path d="M10.24 4.5h-1.8V9h4.5V7.2h-2.7z"/>
            </symbol>
            <symbol id="wbsico-views" viewBox="0 0 26 18">
                <path d="M13.1 0C7.15.02 2.08 3.7.02 8.9L0 9a14.1 14.1 0 0 0 13.09 9c5.93-.02 11-3.7 13.06-8.9l.03-.1A14.1 14.1 0 0 0 13.1 0zm0 15a6 6 0 0 1-5.97-6v-.03c0-3.3 2.67-5.97 5.96-5.98a6 6 0 0 1 5.96 6v.04c0 3.3-2.67 5.97-5.96 5.98zm0-9.6a3.6 3.6 0 1 0 0 7.2 3.6 3.6 0 0 0 0-7.2h-.01z"/>
            </symbol>
            <symbol id="wbsico-comment" viewBox="0 0 18 18">
                <path d="M9 0C4.05 0 0 3.49 0 7.88s4.05 7.87 9 7.87c.45 0 .9 0 1.24-.11L15.75 18v-4.95A7.32 7.32 0 0 0 18 7.88C18 3.48 13.95 0 9 0z"/>
            </symbol>
            <symbol id="wbsico-poster" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14 0a2 2 0 012 2v12a2 2 0 01-2 2H2a2 2 0 01-2-2V2C0 .9.9 0 2 0h12zm0 2H2v12h12V2zm-6 9a1 1 0 110 2 1 1 0 010-2zm5-8v7H3V3h10z"/>
            </symbol>
            <symbol id="wbsico-tick" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M7 11.4L3.6 8 5 6.6l2 2 4-4L12.4 6 7 11.4zM8 0a8 8 0 00-8 8 8 8 0 008 8 8 8 0 008-8 8 8 0 00-8-8z"/>
            </symbol>
            <symbol id="sico-base" viewBox="0 0 18 18">
                <title>sico-base</title>
                <path d="M15.75 6.75h-4.5v-2.25h4.5v2.25zM15.75 13.5h-2.588c-0.338 0.675-1.125 1.125-1.912 1.125-1.243 0-2.25-1.007-2.25-2.25v0c0-1.237 1.013-2.25 2.25-2.25 0.815 0.014 1.522 0.458 1.907 1.114l0.006 0.011h2.588v2.25zM6.75 7.875c-0.815-0.014-1.522-0.458-1.907-1.114l-0.006-0.011h-2.587v-2.25h2.587c0.338-0.675 1.125-1.125 1.913-1.125 1.243 0 2.25 1.007 2.25 2.25v0c0 1.243-1.007 2.25-2.25 2.25v0zM6.75 13.5h-4.5v-2.25h4.5v2.25zM15.75 0h-13.5c-1.243 0-2.25 1.007-2.25 2.25v0 13.5c0 1.238 1.012 2.25 2.25 2.25h13.5c1.243 0 2.25-1.007 2.25-2.25v0-13.5c0-1.243-1.007-2.25-2.25-2.25v0z"></path>
            </symbol>
            <symbol id="sico-filter" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M16 .6a1 1 0 00-1-.6H1a1 1 0 00-.8 1.6L6 9.3V15c0 .6.5 1 1 1h2c.6 0 1-.4 1-1V9.3l5.8-7.7c.3-.3.3-.7.1-1"/>
            </symbol>
            <symbol id="sico-img" viewBox="0 0 16 16">
                <g fill-rule="evenodd"><path d="M15 0H1C.4 0 0 .4 0 1v14c0 .6.4 1 1 1h14c.6 0 1-.4 1-1V1c0-.6-.4-1-1-1zM2 2h12v12H2V2z"/><path d="M6.1 10.3l3 2L13.4 8 12 6.6 8.9 9.7l-3-2L2.6 11 4 12.4l2.1-2.1M7 4a1 1 0 110 2 1 1 0 010-2"/></g>
            </symbol>
            <symbol id="sico-scan" viewBox="0 0 17 16">
                <g fill-rule="evenodd"><path d="M2 2h4V0H0v6h2zM10 2h4v4h2V0h-6zM14 14h-4v2h6v-6h-2zM2 10H0v6h6v-2H2zM4 6h8v4H4z"/></g>
            </symbol>
            <symbol id="sico-pro" viewBox="0 0 32 16">
                <g fill="none" fill-rule="evenodd">
                    <rect width="32" height="16" fill="#06C" rx="3"/>
                    <path fill="#FFF" fill-rule="nonzero" d="M8.2 12V8.8h1.1c1 0 1.8-.2 2.4-.8.7-.6 1-1.3 1-2.2 0-.8-.3-1.5-.8-2-.6-.5-1.3-.7-2.3-.7H7v9h1.2zm1-4.3h-1V4h1.2c1.3 0 2 .6 2 1.8 0 .6-.1 1-.5 1.4-.4.3-1 .5-1.6.5zm6.1 4.4V8.8c0-.7.2-1.2.5-1.6.3-.5.6-.7 1-.7l.9.2V5.6l-.6-.1c-.8 0-1.4.5-1.7 1.4V5.6h-1.2v6.5h1.1zm6 .1c1 0 1.8-.3 2.4-1 .6-.5 1-1.4 1-2.4s-.4-1.9-1-2.5a3 3 0 00-2.2-.9c-1 0-1.8.4-2.4 1-.6.6-1 1.4-1 2.5 0 1 .4 1.8 1 2.4a3 3 0 002.3 1zm.1-1a2 2 0 01-1.5-.6c-.4-.4-.6-1-.6-1.7 0-.8.2-1.4.6-1.8.4-.5.9-.7 1.5-.7.7 0 1.2.2 1.5.6.4.4.5 1 .5 1.8s-.1 1.4-.5 1.8c-.3.5-.8.7-1.5.7z"/>
                </g>
            </symbol>

        </defs>
    </svg>
</div>

<div id="optionsframework-wrap" class="wbs-wrap wbps-wrap v-wp" data-wba-source="<?php echo $pd_code; ?>" v-cloak>
    <div id="version_tips" v-if="new_ver">
        <div class="update-message notice inline notice-warning notice-alt">

            <p>当前<?php echo $pd_title;?>有新版本可用. <a href="<?php echo $pd_index_url; ?>" data-wba-campaign="notice-bar#J_updateRecordsSection" target="_blank">查看版本<span class="ver">{{new_ver}}</span> 详情</a>
                或 <a href="<?php echo admin_url('/plugins.php?plugin_status=upgrade');?>" class="update-link" aria-label="现在更新<?php echo $pd_title;?>">现在更新</a>.
            </p>

        </div>
    </div>


    <div class="wbs-header">
        <svg class="wb-icon sico-wb-logo"><use xlink:href="#sico-wb-logo"></use></svg>
        <span>WBOLT</span>
        <strong><?php echo $pd_title; ?><i class="tag-pro" v-if="is_pro">PRO版</i><i class="tag-pro free" v-if="!is_pro">Free版</i></strong>

        <div class="links">
            <a class="wb-btn" href="<?php echo $pd_index_url; ?>" data-wba-campaign="title-bar" target="_blank">
                <svg class="wb-icon sico-plugins"><use xlink:href="#sico-plugins"></use></svg>
                <span>插件主页</span>
            </a>
            <a class="wb-btn" href="<?php echo $pd_doc_url; ?>" data-wba-campaign="title-bar" target="_blank">
                <svg class="wb-icon sico-doc"><use xlink:href="#sico-doc"></use></svg>
                <span>说明文档</span>
            </a>
        </div>
    </div>

    <div class="wbs-main" id="optionsframework">
        <div class="wbs-aside">
            <ul class="wbs-tabs wbs-menu">
                <li class="tab-item" @click="currentTab='base'">
                    <a class="lv1" :class="{current: currentTab=='base'}">
                        <svg class="wb-icon sico-base"><use xlink:href="#sico-base"></use></svg>
                        <span>基本设置</span>
                    </a>
                    <div class="sub-menu">
                        <a href="#scBase"><span>常规设置</span></a>
                        <a href="#scProxy"><span>代理设置</span></a>
                        <a href="#scImage"><span>图片选项</span></a>
                        <a href="#scRule"><span>过滤规则</span></a>
                    </div>
                </li>

                <li class="tab-item">
                    <a class="lv1" :class="{current: currentTab=='overall'}" @click="currentTab='overall'" href="#">
                        <svg class="wb-icon sico-base"><use xlink:href="#sico-scan"></use></svg>
                        <span>全局扫描</span>
                    </a>
                </li>

                <li class="tab-item">
                    <a class="lv1" :class="{current: currentTab=='extension'}" @click="currentTab='extension'" href="#">
                        <svg class="wb-icon sico-base"><use xlink:href="#sico-img"></use></svg>
                        <span>采集助手</span>
                        <i class="tag-pro">Pro</i>
                    </a>
                </li>
                <li class="tab-item">
                    <a class="lv1" :class="{current: currentTab=='about_pro'}" @click="currentTab='about_pro'" href="#">
                        <svg class="wb-icon sico-more"><use xlink:href="#sico-more"></use></svg>
                        <span>Pro版本</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="wbs-content option-form">
            <div class="sc-wp" v-show="currentTab == 'base'" id="scBase">
                <div class="sc-header">
                    <h3><strong>常规设置</strong></h3>
                </div>
                <div class="sc-body ">
                    <table class="wbs-form-table">
                        <tbody>
                        <tr>
                            <th class="row w8em">
                                自动或手动
                            </th>
                            <td>
                                <div class="selector-bar">
                                    <label><input type="radio" v-model="opt.mode" value="0"> 自动</label>
                                    <label><input type="radio" v-model="opt.mode" value="1"> 手动</label>
                                </div>
								<div class="description mt">*采用自动采集，仅当保存文章或者页面时，进入自动采集图片队列。自动采集仅可用服务器或者代理采集模式，浏览器采集模式仅支持手动采集。</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="row w8em">
                                默认采集模式
                            </th>
                            <td>
                                <div class="selector-bar">
                                    <label><input type="radio" v-model="opt.df_mode" value="none"> 服务器采集</label>
                                    <label v-if="opt.proxy_manual.length<1"><input type="radio" v-model="opt.df_mode" @click="set_df_mode" value="proxy"> 代理采集</label>

                                    <label v-for="(v,idx) in opt.proxy_manual"><input type="radio" v-model="opt.df_mode" :value="idx"> 代理[{{v.name}}]采集</label>

                                    <label><input type="radio" v-model="opt.df_mode" @click="set_df_mode" value="ext"> 浏览器采集</label>
                                </div>
                                <div class="description mt"></div>
                            </td>
                        </tr>
                        <tr>
                            <th class="row">
                                特色图片
                            </th>
                            <td>
                                <div class="selector-bar">
                                    <label><input type="checkbox" v-model="opt.thumbnail" true-value="1"> <span>默认采集第一张图片为特色图片</span></label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="sc-header" id="scProxy">
                    <h3><strong>代理设置</strong></h3>
                </div>
                <div class="sc-body">
                    <table class="wbs-table">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>IP地址</th>
                            <th>端口</th>
                            <th>用户名</th>
                            <th>密码</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <body>

                        <tr v-for="(v,idx) in opt.proxy_manual">
                            <td><input class="wbs-input" v-model="v.name"></td>
                            <td><input class="wbs-input" v-model="v.ip"></td>
                            <td><input class="wbs-input" v-model="v.port"></td>
                            <td><input class="wbs-input" v-model="v.user"></td>
                            <td><input class="wbs-input" type="password" v-model="v.pwd"></td>
                            <td><a class="button-link-delete" @click="removeProxy(idx)">删除</a> </td>
                        </tr>
                        </body>
                    </table>

                    <p class="align-right mt">
                        <a class="wb-btn" @click="addNewProxy">+ 添加代理</a>
                    </p>
                    <div class="description mt">注：若自定义代理IP地址无用户名及密码，则留空即可。仅勾选自动采集默认，自动采集图片才使用代理服务器采集。</div>
                </div>

                <div class="sc-header" id="scImage">
                    <h3><strong>图片选项</strong></h3>
                </div>
                <div class="sc-body">
                    <table class="wbs-form-table">
                        <tr>
                            <th class="row w8em">尺寸规格</th>
                            <td>
                                <div class="selector-items-block">
                                    <label><input type="radio" v-model="opt.rule.size" value="0"> 原尺寸（默认）</label>
                                    <label><input type="radio" v-model="opt.rule.size" value="1"> 不超过1080px宽度</label>
                                    <label><input type="radio" v-model="opt.rule.size" value="2"> 不超过720px宽度</label>
                                    <label><input type="radio" v-model="opt.rule.size" value="3"> 不超过<span class="ml">
                                <input class="wbs-input w6em" v-model="opt.rule.custom_size" placeholder=""> <span class="description">px宽度</span>
                            </span></label>
                                </div>
                                <div class="description mt">注：不超过指定宽度，即若采集图片的宽度像素超出设置值，将压缩为指定值宽度。如要保留原尺寸图片，使用默认值即可。</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="row">文件名规则</th>
                            <td>
                                <div class="selector-items-block">
                                    <label><input type="radio" v-model="opt.rule.file_name" value="0"> 系统自动命名（默认）</label>
                                    <label><input type="radio" v-model="opt.rule.file_name" value="1"> 保留原文件名</label>
                                    <label><input type="radio" v-model="opt.rule.file_name" value="2"> 自定义 <span class="ml" v-if="opt.rule.file_name == '2'">
                                        <input class="wbs-input wbs-input-short" v-model="opt.rule.custom_name" placeholder=""></span></label>
                                </div>

                                <div class="description" v-if="opt.rule.file_name == '2'">
                                    <p class="mt"><b>请选择自定义方式：</b></p>
                                    <p>%filename% : 原文件名</p>
                                    <p>%date% : 年月日，例：20200101</p>
                                    <p>%year% : 年份，例：2020。</p>
                                    <p>%month% : 月份，例如：01。</p>
                                    <p>%day% : 日期，例如：15。</p>
                                    <p>%random% : 五位数字字母随机码，例如：m1x88。</p>
                                </div>
                                <div class="description">注：自定义文件名可以使用一个或者多个命名规则参数。比如可以设置为%filename%%date%。</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="row">标题及替代文本</th>
                            <td>
                                <div class="selector-items-block">
                                    <label><input type="radio" v-model="opt.rule.title_alt" value="0"> 保留来源数据（默认）</label>
                                    <label><input type="radio" v-model="opt.rule.title_alt" value="1"> 自定义 <span class="ml" v-if="opt.rule.title_alt == '1'">
                                        <input class="wbs-input wbs-input-short" v-model="opt.rule.custom_title" placeholder=""></span></label>
                                </div>

                                <div class="description" v-if="opt.rule.title_alt == '1'">
                                    <p class="mt"><b>请选择自定义方式：</b></p>
                                    <p>%filename% : 原文件名</p>
                                    <p>%postname% : 文章标题</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="row">对齐方式</th>
                            <td>
                                <div class="selector-bar">
                                    <label><input type="radio" v-model="opt.rule.align" value="none"> 无（默认）</label>
                                    <label><input type="radio" v-model="opt.rule.align" value="center"> 居中对齐</label>
                                    <label><input type="radio" v-model="opt.rule.align" value="left"> 左对齐</label>
                                    <label><input type="radio" v-model="opt.rule.align" value="right"> 右对齐</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="sc-header" id="scRule">
                    <h3><strong>过滤规则</strong></h3>
                </div>
                <div class="sc-body">
                    <table class="wbs-form-table">
                        <tbody>
                        <tr>
                            <th class="row w8em">
                                过滤指定顺序图像
                            </th>
                            <td><span>第</span> <input v-model="opt.filter.except_index" class="wbs-input w6em"> <span>张图片（多个请用英文逗号隔开）</span></td>
                        </tr>
                        <tr>
                            <th class="row">
                                过滤特定尺寸图像
                            </th>
                            <td><span>宽度像素低于</span> <input v-model="opt.filter.min_width" class="wbs-input w6em" > <span>像素</span></td>
                        </tr>
                        <tr>
                            <th class="row">
                                过滤格式
                            </th>
                            <td>
                                <div class="selector-bar">
                                    <label><input type="checkbox" v-model="opt.filter.type.jpg" true-value="1" false-value="0"> <span>jpg</span></label>
                                    <label><input type="checkbox" v-model="opt.filter.type.jpeg" true-value="1" false-value="0"> <span>jpeg</span></label>
                                    <label><input type="checkbox" v-model="opt.filter.type.png" true-value="1" false-value="0"> <span>png</span></label>
                                    <label><input type="checkbox" v-model="opt.filter.type.gif" true-value="1" false-value="0"> <span>gif</span></label>
                                    <label><input type="checkbox" v-model="opt.filter.type.bmp" true-value="1" false-value="0"> <span>bmp</span></label>
                                    <label><input type="checkbox" v-model="opt.filter.type.webp" true-value="1" false-value="0"> <span>webp</span></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="row">
                                排除图像域名
                            </th>
                            <td>
                                <div class="sc-block" v-for="(v,idx) in opt.filter.domain">
                                    <input class="wbs-input wbs-input-short" v-model="opt.filter.domain[idx]"> <span class="link" @click="del_filter_domain(idx)">删除</span>
                                </div>
                                <div class="sc-block">
                                    <input class="wbs-input wbs-input-short" v-model="filter_domain" placeholder=""> <span class="link" @click="add_filter_domain()">增加 +</span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div id="scOverall" class="sc-wp" v-show="currentTab == 'overall'">
                <div class="sc-header">
                    <h3><strong>全局扫描</strong></h3>
                </div>
                <div class="sc-body">
                <table class="wbs-form-table">
                    <tbody>
                    <tr>
                        <th class="row w8em">扫描类型</th>
                        <td>
                            <div class="selector-bar">
                                <label v-for="(v,key) in job.post_types"><input type="checkbox" v-model="job.scan_type" :value="key"> <span>{{v}}</span></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="row">例外地址</th>
                        <td>
                            <div class="sc-block" v-for="(v,idx) in job.domain">
                                <input class="wbs-input wbs-input-short" v-model="job.domain[idx]"> <span class="link" @click="del_scan_domain(idx)">删除</span>
                            </div>
                            <div class="sc-block">
                                <input class="wbs-input wbs-input-short" v-model="scan_domain" placeholder=""> <span class="link" @click="add_scan_domain()">增加 +</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="row"></th>
                        <td>
                            <span class="button button-disabled" v-show="scan_status">{{job.percent == 100 ? '扫描完成' : '扫描中'}}</span>
                            <a class="button-primary" @click="run_scan();scan_status=1" v-show="!scan_status">执行扫描</a>
                            <p class="description mt">注：仅且站点能够正常加载的外链图片，才可以使用图片采集助手执行全局扫描采集。</p>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="scan-result" v-show="scan_status">
                    <div class="status-bar" :class="{'done':job.percent == 100}">
                        <div class="bar-inner">
                            <span>{{job.scan_num}}/{{job.scan_total}}</span> <span>({{job.percent}}%)</span>
                        </div>
                        <div class="bar" :style="'width:'+ job.percent +'%;'"></div>
                    </div>

                    <div class="description mt align-center" v-if="scan.finnish"><svg class="wb-icon wbsico-tick"><use xlink:href="#wbsico-tick"></use></svg> <span class="ib">扫描完成，查找到{{scan.num}}张站外图片。</span></div>
                    <h4 class="sc-title-sub">
                        <span>扫描记录</span>
                    </h4>
                    <div><!--style="max-height: 500px; overflow-y: scroll;"-->
                    <table class="wbs-table">
                        <thead>
                        <tr>
                            <th class="td-select"><input type="checkbox" true-value="1" false-value="0" v-model="job.chk_all" @click="check_all()"></th>
                            <th>扫描地址</th>
                            <th>外链图片</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <body>
                            <tr v-for="(img,idx) in job.images">
                                <td><input v-if="img.status==0" type="checkbox" v-model="job.scan" :value="img.id"></td>
                                <td><a :href="img.url" target="_blank"><span class="url">{{img.url}}</span></a></td>
                                <td><span class="url">{{img.src}}</span></td>
                                <td>{{{0:'未采集',1:'成功',2:'失败',3:'采集中...'}[img.status]}}</td>
                                <td><!--<a class="link">采集</a> --> <a v-if="img.status==0 && job.is_download!=1" class="link" @click="del_scan_img(idx)">放弃</a></td>
                            </tr>

                        <tr v-show="load_more"><td colspan="5"><div class="btns-bar">
                                    <a class="more-btn" @click="load_more_img()">查看更多</a>
                                </div>
                            </td> </tr>
                        </body>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <button class="button button-primary" v-bind:disabled="job.scan.length==0 || job.is_download==1" @click="down_selected_scan_img()">批量采集</button>
                                    <button class="button button-cancel" v-bind:disabled="job.scan.length==0 || job.is_download==1" @click="drop_selected_scan_img()">批量放弃</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                        <div class="description mt" v-if="job.run_finnish">批量采集任务完成，{{job.succ_num}}张图片成功，{{job.fail_num}}张图片失败。</div>


                        <div style="display:none;">
                            <button type="button" id="wb-wbsm-btn-spy-batch-ext"></button>
                        </div>
                    </div>
                </div>
            </div>
            </div>


            <div id="scExtension" class="sc-wp" v-show="currentTab == 'extension'">
                <div class="introduce-panel">
                    <div class="ip-hd">
                        <strong>图片采集助手</strong>
                        <span>imgSpider Pro插件必装工具</span>
                    </div>

                    <div class="dl-bar">
                        <a class="wbs-btn" @click="down_extension()">立即下载安装</a>
                        <p>当前最新版本：V{{new_ver_ce}} <span v-if="ext_ver">{{ext_ver}}</span></p>
                    </div>

                    <div class="wbolt-products tabs-box intro-box">
                        <div class="tab-navs">
                            <div class="tab-nav-item" :class="{'current':intro_tab_index==0}" @click="intro_tab_index=0"><span>插件安装步骤</span></div>
                            <div class="tab-nav-item" :class="{'current':intro_tab_index==1}" @click="intro_tab_index=1"><span>插件更新步骤</span></div>
                        </div>
                        <div class="tab-conts">
                            <div class="tab-cont" :class="{'current':intro_tab_index==0}">
                                <h3>1.下载安装文件</h3>
                                <p>下载压缩包插件，然后存放到（例如：D盘）解压</p>
                                <h3>2.打开浏览器扩展程序安装页面</h3>
                                <p>复制<span class="hl" href="chrome://extensions">chrome://extensions</span>，并粘贴到地址栏，按回车键进入扩展中心页面。在扩展中心打开右上角的<span class="hl">【开发者模式】</span>按钮</p>
                                <p><img src="<?php echo IMGSPY_URI.'assets/img/chrome-extensions.png'; ?>" alt=""></p>
                                <h3>3.安装插件</h3>
                                <p>点击左上角“<span class="hl">加载已解压的扩展程序</span>”，在文件夹弹框窗口中选中刚解压的文件存放位置。点击确定即可。</p>
                                <p><img src="<?php echo IMGSPY_URI.'assets/img/chrome-extensions-02.png'; ?>" alt=""></p>
                            </div>
                            <div class="tab-cont" :class="{'current':intro_tab_index==1}">
                                <h3>1.下载安装文件</h3>
                                <p>下载压缩包插件到旧版本的安装路径，并解压覆盖旧版本文件即可。</p>
                                <h3>2.打开浏览器扩展程序安装页面</h3>
                                <p>复制<span class="hl">chrome://extensions</span>，并粘贴到地址栏，按回车键进入扩展中心页面。在扩展中心用Ctrl+R（Command+R）进行刷新，然后点击插件工具上的刷新按钮即可使用。</p>
                                <p><img src="<?php echo IMGSPY_URI.'assets/img/chrome-extensions-03.png'; ?>" alt=""></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="sc-wp" v-show="currentTab == 'about_pro'">
                <div class="table-comparison">
                    <ul class="table-hd">
                        <li class="hd"><i class="pfc" title="功能对比"></i></li>
                        <li class="free">
                            <strong>免费版</strong>
                            <i class="gf-free">
                                <img src="<?php echo IMGSPY_URI.'/assets/img/imgspider_icon.png'; ?>" alt="">
                            </i>
                        </li>
                        <li class="pro">
                            <strong>专业版</strong>
                            <i class="gf-pro">
                                <img src="<?php echo IMGSPY_URI.'/assets/img/imgspider_pro_icon.png'; ?>" alt="">
                            </i>
                        </li>
                    </ul>
                    <dl class="tr">
                        <dt>自动采集</dt>
                        <dd class="free"><i class="wbicon-tick"></i></dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>手动采集</dt>
                        <dd class="free"><i class="wbicon-tick"></i></dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>代理服务器</dt>
                        <dd class="free"><i class="wbicon-tick"></i></dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>图片尺寸设置</dt>
                        <dd class="free"><i class="wbicon-tick"></i></dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>图片命名规则</dt>
                        <dd class="free"><i class="wbicon-tick"></i></dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>图片标题&ALT规则</dt>
                        <dd class="free"><i class="wbicon-tick"></i></dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>图片对齐方式</dt>
                        <dd class="free"><i class="wbicon-tick"></i></dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>全局扫描采集</dt>
                        <dd class="free"><i class="wbicon-tick"></i></dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>图片采集助手</dt>
                        <dd class="free">无</dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>高效率采图</dt>
                        <dd class="free">无</dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>加密图片采集</dt>
                        <dd class="free">无</dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>微信图片采集</dt>
                        <dd class="free">无</dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>头条图片采集</dt>
                        <dd class="free">无</dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>超级图片压缩</dt>
                        <dd class="free">无</dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>WebP转JPG</dt>
                        <dd class="free">无</dd>
                        <dd class="pro"><i class="wbicon-tick"></i></dd>
                    </dl>
                    <dl class="tr">
                        <dt>第三方云存储</dt>
                        <dd class="free">无</dd>
                        <dd class="pro">Coming soon</dd>
                    </dl>
                    <dl class="tr">
                        <dt>图片水印</dt>
                        <dd class="free">无</dd>
                        <dd class="pro">Coming soon</dd>
                    </dl>
                    <dl class="tr tr-btns">
                        <dt></dt>
                        <dd class="free"></dd>
                        <dd class="pro">
                            <a class="wbs-btn wbs-btn-primary" v-if="!is_pro" @click="activePro">立即激活</a>
                            <span class="wbs-btn wbs-btn-outlined" v-if="is_pro">已激活</span>
                        </dd>
                    </dl>
                </div>
            </div>


            <div id="scMore">
                <more-wb-info v-bind:utm-source="pd_code"></more-wb-info>
            </div>

            <div class="wb-copyright-bar">
                <div class="wbcb-inner">
                    <a class="wb-logo" href="https://www.wbolt.com" data-wba-campaign="footer" title="WBOLT" target="_blank"><svg class="wb-icon sico-wb-logo"><use xlink:href="#sico-wb-logo"></use></svg></a>
                    <div class="wb-desc">
                        Made By <a href="https://www.wbolt.com" data-wba-campaign="footer" target="_blank">闪电博</a>
                        <span class="wb-version">版本：<?php echo $pd_version;?></span>
                    </div>
                    <div class="ft-links">
                        <a href="https://www.wbolt.com/plugins" data-wba-campaign="footer" target="_blank">免费插件</a>
                        <a href="https://www.wbolt.com/docs" data-wba-campaign="footer" target="_blank">插件支持</a>
                        <a href="<?php echo $pd_doc_url; ?>" data-wba-campaign="footer" target="_blank">说明文档</a>
                        <a href="https://www.wbolt.com/terms-conditions" data-wba-campaign="footer" target="_blank">服务协议</a>
                        <a href="https://www.wbolt.com/privacy-policy" data-wba-campaign="footer" target="_blank">隐私条例</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="wbs-footer" id="optionsframework-submit">
        <div class="wbsf-inner">
            <button class="wbs-btn-primary" type="button" name="update" @click="updateData">保存设置</button>
        </div>
    </div>
</div>



