var main = function(){
	var tools = [
		  'title',
		  'bold',
		  'italic',
		  'underline',
		  'strikethrough',
		  'fontScale',
		  'color',
		  'ol',
		  'ul',
		  'blockquote',
		  'code',
		  'table',
		  'link',
		  'image',
		  'hr',
		  'indent',
		  'outdent',
		  'alignment'
		];
		
		var editor = new Simditor({
		  textarea: $('#text'),
		  placeholder: '请输入正文...',
		  defaultImage: 'public/simditor-2.3.6/images/image.png',
		  params: {},
		  upload:true,									//是否启用上传
		  tabIndent: true,								//是否启用Tab键
		  toolbar: tools,								//工具栏设置
		  toolbarFloat: true,							//是否浮动工具栏
		  toolbarFloatOffset: 0,						//工具栏浮动偏移
		  toolbarHidden: false,							//是否隐藏工具栏
		  pasteImage: true,								//是否粘贴图片
		  cleanPaste: false								//是否清除标签
		});
	window['editor'] = editor;
};
$(window).ready(main);
