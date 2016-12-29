/**
 * KindEditor配置文件
 * author: xiayulei@gmail.com
 */
var KindEditorOptions = {
    items: [
        'source', '|', 'preview', 'code', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
        'media', 'insertfile', 'table', 'hr', 'baidumap', 'pagebreak',
        'anchor', 'link', 'unlink', '|', 'about'
    ],

    /**
     * true时根据 htmlTags 过滤HTML代码，false时允许输入任何代码。
     */
    filterMode: false,

    /**
     * 指定要保留的HTML标记和属性。Object的key为HTML标签名，value为HTML属性数组，”.”开始的属性表示style属性。
     */
    htmlTags: {
        font: ['color', 'size', 'face', '.background-color'],
        span: [
            '.color', '.background-color', '.font-size', '.font-family', '.background',
            '.font-weight', '.font-style', '.text-decoration', '.vertical-align', '.line-height'
        ],
        div: [
            'align', '.border', '.margin', '.padding', '.text-align', '.color',
            '.background-color', '.font-size', '.font-family', '.font-weight', '.background',
            '.font-style', '.text-decoration', '.vertical-align', '.margin-left'
        ],
        table: [
            'border', 'cellspacing', 'cellpadding', 'width', 'height', 'align', 'bordercolor',
            '.padding', '.margin', '.border', 'bgcolor', '.text-align', '.color', '.background-color',
            '.font-size', '.font-family', '.font-weight', '.font-style', '.text-decoration', '.background',
            '.width', '.height', '.border-collapse'
        ],
        'td,th': [
            'align', 'valign', 'width', 'height', 'colspan', 'rowspan', 'bgcolor',
            '.text-align', '.color', '.background-color', '.font-size', '.font-family', '.font-weight',
            '.font-style', '.text-decoration', '.vertical-align', '.background', '.border'
        ],
        a: ['href', 'target', 'name'],
        embed: ['src', 'width', 'height', 'type', 'loop', 'autostart', 'quality', '.width', '.height', 'align', 'allowscriptaccess'],
        img: ['src', 'width', 'height', 'border', 'alt', 'title', 'align', '.width', '.height', '.border'],
        'p,ol,ul,li,dl,dt,dd,blockquote,h1,h2,h3,h4,h5,h6': [
            'class', 'id',
            'align', '.text-align', '.color', '.background-color', '.font-size', '.font-family', '.background',
            '.font-weight', '.font-style', '.text-decoration', '.vertical-align', '.text-indent', '.margin-left'
        ],
        pre: ['class'],
        hr: ['class', '.page-break-after'],
        'br,tbody,tr,strong,b,sub,sup,em,i,u,strike,s,del': [],
        iframe: ['src', 'width', 'height', 'style']
    },
    themeType: 'simple',
    /**
     * 设置回车换行标签，可设置”p”、”br”。
     * 默认值: “p”
     */
    newlineTag: "p",
    minHeight: 300,
    filePostName: "file",
    uploadJson: "/index.php/api/upload/upload",
    cssPath: GV.base_url + "/js/kindeditor/kindeditor.css",
    allowMediaUpload: false,
    allowFileUpload: false,
    afterBlur: function () {
        this.sync();
    }
};