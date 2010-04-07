-- 
-- 导出表中的数据 `joys_role`
-- 

INSERT INTO `joys_role` VALUES (1, '超级管理员', 0, 1, '超级管理员分组');
INSERT INTO `joys_role` VALUES (2, '普通管理员', 0, 1, '普通管理员分组');
INSERT INTO `joys_role` VALUES (3, '注册用户', 0, 1, '注册用户分组');


-- 
-- 导出表中的数据 `joys_user`
-- 

INSERT INTO `joys_user` VALUES (1, '~`~ADMINNAME~`~', '~`~ADMINPWD~`~', 'administrator', 'admin@admin.com', '2010-03-01 09:23:44', '2010-03-23 21:39:15', 1, '');



-- 
-- 导出表中的数据 `joys_role_user`
-- 

INSERT INTO `joys_role_user` VALUES (1, 1);

-- 
-- 导出表中的数据 `joys_node`
-- 

INSERT INTO `joys_node` VALUES (1, 'Admin', '后台管理', 1, '后台项目', 0, 0, 1);
INSERT INTO `joys_node` VALUES (2, 'Section', '单元管理', 1, '控制器', 1, 1, 2);
INSERT INTO `joys_node` VALUES (3, 'Category', '分类管理', 1, '控制器', 2, 1, 2);
INSERT INTO `joys_node` VALUES (4, 'Article', '文章管理', 1, '控制器', 3, 1, 2);
INSERT INTO `joys_node` VALUES (5, 'Index', '后台默认', 1, '控制器', 0, 1, 2);
INSERT INTO `joys_node` VALUES (6, 'Public', '公共管理', 1, '控制器', 0, 1, 2);
INSERT INTO `joys_node` VALUES (7, 'index', '单元列表', 1, '动作', 0, 2, 3);
INSERT INTO `joys_node` VALUES (8, 'add', '添加单元', 1, '动作', 9, 2, 3);
INSERT INTO `joys_node` VALUES (9, 'edit', '编辑单元', 1, '动作', 0, 2, 3);
INSERT INTO `joys_node` VALUES (10, 'delete', '删除单元', 1, '动作', 0, 2, 3);
INSERT INTO `joys_node` VALUES (11, 'index', '默认动作', 1, '动作', 0, 5, 3);
INSERT INTO `joys_node` VALUES (12, 'index', '分类列表', 1, '动作', 0, 3, 3);
INSERT INTO `joys_node` VALUES (13, 'User', '用户管理', 1, '控制器', 0, 1, 2);
INSERT INTO `joys_node` VALUES (14, 'index', '用户列表', 1, '动作', 0, 13, 3);
INSERT INTO `joys_node` VALUES (15, 'add', '添加用户', 1, '动作', 0, 13, 3);
INSERT INTO `joys_node` VALUES (16, 'edit', '编辑用户', 1, '动作', 0, 13, 3);
INSERT INTO `joys_node` VALUES (17, 'delete', '删除用户', 1, '动作', 0, 13, 3);
INSERT INTO `joys_node` VALUES (18, 'Role', '用户分组管理', 1, '控制器', 0, 1, 2);
INSERT INTO `joys_node` VALUES (19, 'index', '用户分组列表', 1, '动作', 0, 18, 3);
INSERT INTO `joys_node` VALUES (20, 'add', '用户分组添加', 1, '动作', 0, 18, 3);
INSERT INTO `joys_node` VALUES (21, 'edit', '用户分组编辑', 1, '动作', 0, 18, 3);
INSERT INTO `joys_node` VALUES (22, 'delete', '用户分组删除', 1, '动作', 0, 18, 3);
INSERT INTO `joys_node` VALUES (23, 'add', '添加分类', 1, '动作', 0, 3, 3);
INSERT INTO `joys_node` VALUES (24, 'edit', '编辑分类', 1, '动作', 0, 3, 3);
INSERT INTO `joys_node` VALUES (25, 'delete', '删除分类', 1, '动作', 0, 3, 3);
INSERT INTO `joys_node` VALUES (26, 'index', '文章列表', 1, '动作', 0, 4, 3);
INSERT INTO `joys_node` VALUES (27, 'add', '添加文章', 1, '动作', 0, 4, 3);
INSERT INTO `joys_node` VALUES (28, 'edit', '编辑文章', 1, '动作', 0, 4, 3);
INSERT INTO `joys_node` VALUES (29, 'delete', '删除文章', 1, '动作', 0, 4, 3);
INSERT INTO `joys_node` VALUES (30, 'Menu', '菜单管理', 1, '控制器', 0, 1, 2);
INSERT INTO `joys_node` VALUES (31, 'index', '菜单列表', 1, '动作', 0, 30, 3);
INSERT INTO `joys_node` VALUES (32, 'add', '添加菜单', 1, '动作', 0, 30, 3);
INSERT INTO `joys_node` VALUES (33, 'edit', '编辑菜单', 1, '动作', 0, 30, 3);
INSERT INTO `joys_node` VALUES (34, 'delete', '删除菜单', 1, '动作', 0, 30, 3);
INSERT INTO `joys_node` VALUES (35, 'MenuItem', '菜单项管理', 1, '控制器', 0, 1, 2);
INSERT INTO `joys_node` VALUES (36, 'component', '菜单项选择内容', 1, '动作', 0, 35, 3);
INSERT INTO `joys_node` VALUES (37, 'add', '添加菜单项', 1, '动作', 0, 35, 3);
INSERT INTO `joys_node` VALUES (38, 'edit', '编辑菜单项', 1, '动作', 0, 35, 3);
INSERT INTO `joys_node` VALUES (39, 'index', '菜单项列表', 1, '动作', 0, 35, 3);
INSERT INTO `joys_node` VALUES (40, 'Modules', '模块管理', 1, '控制器', 0, 1, 2);
INSERT INTO `joys_node` VALUES (41, 'modules', '选择模块', 1, '动作', 0, 40, 3);
INSERT INTO `joys_node` VALUES (42, 'add', '添加模块', 1, '动作', 0, 40, 3);
INSERT INTO `joys_node` VALUES (43, 'edit', '编辑模块', 1, '动作', 0, 40, 3);
INSERT INTO `joys_node` VALUES (44, 'index', '模块列表', 1, '动作', 0, 40, 3);
INSERT INTO `joys_node` VALUES (45, 'delete', '删除模块', 1, '动作', 0, 40, 3);
INSERT INTO `joys_node` VALUES (46, 'delete', '删除菜单项', 1, '动作', 0, 35, 3);


-- 
-- 导出表中的数据 `joys_access`
-- 

INSERT INTO `joys_access` VALUES (1, 1, 1, 0);
INSERT INTO `joys_access` VALUES (1, 2, 2, 1);
INSERT INTO `joys_access` VALUES (1, 9, 3, 2);
INSERT INTO `joys_access` VALUES (1, 7, 3, 2);
INSERT INTO `joys_access` VALUES (2, 7, 3, 2);
INSERT INTO `joys_access` VALUES (1, 5, 2, 1);
INSERT INTO `joys_access` VALUES (1, 11, 3, 5);
INSERT INTO `joys_access` VALUES (2, 1, 1, 0);
INSERT INTO `joys_access` VALUES (1, 8, 3, 2);
INSERT INTO `joys_access` VALUES (2, 2, 2, 1);



-- 
-- 导出表中的数据 `joys_section`
-- 

INSERT INTO `joys_section` VALUES (1, 'PHP教程', 'course', '<p><span style="font-size: medium">乐学PHP学院老师编写的PHP学习教程</span></p>', 1, 0, 0, '');
INSERT INTO `joys_section` VALUES (2, 'PHP培训', 'train', '<p><span style="font-size: medium">乐学PHP学院的PHP培训课程</span></p>', 1, 0, 0, '');
INSERT INTO `joys_section` VALUES (3, 'PHP视频', 'video', '<p><span style="font-size: medium">乐学PHP学院老师录制的PHP视频教程</span></p>', 1, 0, 0, '');
INSERT INTO `joys_section` VALUES (4, 'PHP下载', 'download', '<p><span style="font-size: medium">最新的PHP学习资料、开发工具、开源系统下载</span></p>', 1, 0, 0, '');
INSERT INTO `joys_section` VALUES (5, 'PHP招聘', 'job', '<p><span style="font-size: medium">最新的PHP求职招聘信息</span></p>', 1, 0, 0, '');
INSERT INTO `joys_section` VALUES (6, '在线培训', 'online', '<p><span style="font-size: medium">乐学PHP学院的在线学习平台</span></p>', 1, 0, 0, '');


-- 
-- 导出表中的数据 `joys_category`
-- 

INSERT INTO `joys_category` VALUES (1, 'HTML教程', 'html', '<p><span style="font-size: medium">HTML教程、字体标签、格式标签、表格标签、帧标签等</span></p>', 1, 0, 0, 1, '');
INSERT INTO `joys_category` VALUES (2, 'CSS教程', 'css', '<p><span style="font-size: medium">CSS教程、选择器、DIV+CSS布局等</span></p>', 1, 0, 0, 1, '');
INSERT INTO `joys_category` VALUES (3, 'MySQL教程', 'mysql', '<p><span style="font-size: medium">MySQL教程、基本SQL、存储过程、视图、触发器、事务等</span></p>', 1, 0, 0, 1, '');
INSERT INTO `joys_category` VALUES (4, 'PHP基础教程', 'php', '<p><span style="font-size: medium">PHP基础教程，包括基本开发环境、流程控制、函数、字符串、数组、对象等基础知识</span></p>', 1, 0, 0, 1, '');
INSERT INTO `joys_category` VALUES (5, '项目实战', 'project', '<p><span style="font-size: medium">项目实战</span></p>', 1, 0, 0, 1, '');
INSERT INTO `joys_category` VALUES (6, 'PHP视频', '2010-03-13-20-34-49', '<p>PHP视频</p>', 1, 0, 0, 3, '');
INSERT INTO `joys_category` VALUES (7, '开课通知', '2010-03-13-21-07-30', '<p>开课通知</p>', 1, 0, 0, 2, '');



-- 
-- 导出表中的数据 `joys_article`
-- 

INSERT INTO `joys_article` VALUES (1, 'HTML是什么', 'html01', 'HTML是什么？\r\nHTML是超', '<p>HTML是什么？</p>\r\n<p>HTML是超文本标记语言</p>\r\n<div class="codeText">\r\n<div class="codeHead"><span class="zhedie" id="hit_2081" onclick="javascript:code_2081.style.display=''none'';hit2_2081.style.display='''';hit_2081.style.display=''none'';" style="cursor: pointer">折叠</span><span class="zhedie" id="hit2_2081" onclick="javascript:code_2081.style.display='''';hit_2081.style.display='''';hit2_2081.style.display=''none'';" style="display: none; cursor: pointer">展开</span><span class="lantxt">XML/HTML Code</span><span class="copyCodeText" onclick="copyIdText(''code_2081'')" style="cursor: pointer">复制内容到剪贴板</span></div>\r\n<div id="code_2081">\r\n<ol class="dp-xml">\r\n    <li class="alt"><span><span class="tag">&lt;</span><span class="tag-name">html</span><span class="tag">&gt;</span><span>&nbsp;&nbsp; &nbsp;&nbsp;</span></span></li>\r\n    <li><span class="tag">&lt;</span><span class="tag-name">head</span><span class="tag">&gt;</span><span>&nbsp;&nbsp; &nbsp;&nbsp;</span></li>\r\n    <li class="alt"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="tag">&lt;</span><span class="tag-name">title</span><span class="tag">&gt;</span><span>乐学PHP&nbsp;&ndash;PHP培训与交流平台</span><span class="tag">&lt;/</span><span class="tag-name">title</span><span class="tag">&gt;</span><span>&nbsp;&nbsp; &nbsp;&nbsp;</span></li>\r\n    <li><span class="tag">&lt;/</span><span class="tag-name">head</span><span class="tag">&gt;</span><span>&nbsp;&nbsp; &nbsp;&nbsp;</span></li>\r\n    <li class="alt"><span class="tag">&lt;</span><span class="tag-name">body</span><span class="tag">&gt;</span><span>&nbsp;&nbsp; &nbsp;&nbsp;</span></li>\r\n    <li><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="tag">&lt;</span><span class="tag-name">p</span><span class="tag">&gt;</span><span>欢迎光临乐学PHP</span><span class="tag">&lt;/</span><span class="tag-name">p</span><span class="tag">&gt;</span><span>&nbsp;&nbsp; &nbsp;&nbsp;</span></li>\r\n    <li class="alt"><span class="tag">&lt;/</span><span class="tag-name">body</span><span class="tag">&gt;</span><span>&nbsp;&nbsp; &nbsp;&nbsp;</span></li>\r\n    <li><span class="tag">&lt;/</span><span class="tag-name">html</span><span class="tag">&gt;</span><span>&nbsp;&nbsp;</span></li>\r\n</ol>\r\n</div>\r\n</div>\r\n<p>&nbsp;</p>', 1, 1, 1, '2010-03-01', 1, '2010-03-25 09:34:44', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 3, '', '');
INSERT INTO `joys_article` VALUES (2, 'CSS是什么？', 'css01', 'CSS是什么呢？', '<p>&lt;img /&gt;&nbsp;<a href="http://www.baidu.com">你好</a></p>', 1, 1, 2, '2010-03-01', 1, '2010-03-25 13:58:50', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');
INSERT INTO `joys_article` VALUES (3, 'MySQL是什么?', 'mysql', '', '<p>MySQL是什么？</p>\r\n<p>MySQL是数据库管理系统DBMS。</p>', 1, 1, 3, '2010-03-01', 1, '2010-03-13 20:31:42', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');
INSERT INTO `joys_article` VALUES (4, 'PHP是什么？', 'php01', '', '<p><strong>什么是PHP？</strong></p>\r\n<ul>\r\n    <li><span style="color: #135cae"><a title="PHP" href="http://sky.lampbrother.net/"><font color="#e05e19">PHP</font></a></span>是一种开发语言，始创于1995年，官方网站www.php.net</li>\r\n    <li>PHP的全称是超文本预处理器（Hypertext Preprocessor）</li>\r\n    <li>PHP是一种创建动态交互网站的服务器端脚本语言，通常需要搭配Apache（Web服务器软件）一起使用，不过也可以搭配其他服务器软件，如IIS、Nginx等。</li>\r\n    <li>PHP是最流行的网站开发语言之一，完全免费使用，非常容易上手，与另外三个开源软件组成经典的LAMP组合（Linux+Apache+MySQL+PHP），深受广大网站开发者的喜爱。</li>\r\n    <li>PHP可以直接嵌入<span style="color: #135cae">HTML</span>代码中，非常适合网站开发，下面我们看段代码</li>\r\n</ul>\r\n<h2>PHP能做什么？</h2>\r\n<p>PHP主要用于以下三个领域</p>\r\n<ol>\r\n    <li>服务器端脚本：动态网站开发，乐学就是基于PHP语言，使用经典的CMS开源项目Joomla！建立而成。</li>\r\n    <li>客户端图形用户界面（GUI：Graphics User Interface），如GTK捆绑PHP开发用户图形界面。</li>\r\n    <li>命令行脚本：PHP做为Shell脚本语言来使用。</li>\r\n</ol>\r\n<p>当然PHP主要是用于服务器端的脚本程序，因此您可以用PHP来完成任何其他CGI程序能够完成的工作，例如收集表单数据、生成动态网页、发生/接收Cookie等，PHP的功能远不局限与此。</p>\r\n<h2>PHP的特点</h2>\r\n<ul>\r\n    <li>PHP是开发源代码的，运行于服务器端的脚本语言</li>\r\n    <li>独立于操作系统，可以运行在几乎所有系统中</li>\r\n    <li>支持大部分的服务器软件，如Apache、IIS、Nginx等</li>\r\n    <li>支持大量的数据库软件，如MySQL、Oracle、SQL Server等</li>\r\n    <li>除了动态创建网页外，还可以动态创建图像、Flash、Office文档、XML等。</li>\r\n    <li>还有一些其他功能在后面的高级技术我们会详细介绍。</li>\r\n</ul>', 1, 1, 4, '2010-03-11', 1, '2010-03-13 20:32:44', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');
INSERT INTO `joys_article` VALUES (5, '项目实战（一）', 'project01', '', '<p>项目实战（一）</p>\r\n<p>17Joys是一款基于ThinkPHP框架为基础开发的内容管理系统</p>', 1, 1, 5, '2010-03-13', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');
INSERT INTO `joys_article` VALUES (6, 'PHP入门视频', 'php01', '', '<p>PHP基础视频</p>', 1, 3, 6, '2010-03-13', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');
INSERT INTO `joys_article` VALUES (7, 'PHP表达式视频', '2010-03-13-20-36-28', '', '<p>PHP表达式</p>', 1, 3, 6, '2010-03-13', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');
INSERT INTO `joys_article` VALUES (8, 'PHP流程控制视频', '2010-03-13-20-36-55', '', '<p>PHP流程控制视频</p>', 1, 3, 6, '2010-03-13', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');
INSERT INTO `joys_article` VALUES (9, 'PHP字符串视频', '2010-03-13-20-37-24', '', '<p>PHP</p>', 1, 3, 6, '2010-03-13', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');
INSERT INTO `joys_article` VALUES (10, 'PHP数组视频', '2010-03-13-20-37-44', '', '<p>PHP数组视频</p>', 1, 3, 6, '2010-03-13', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');
INSERT INTO `joys_article` VALUES (11, '乐学PHP -实战精英班第一期', '2010-03-13-21-08-22', '乐学PHP一期', '<p><span style="font-size: medium">乐学PHP -实战精英班第一期</span></p>', 1, 2, 7, '2010-03-13', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 1, '', '');
INSERT INTO `joys_article` VALUES (12, '乐学PHP -实战精英班第二期', '2010-03-13-21-09-52', '乐学PHP二期', '<p><span style="font-size: large">乐学PHP -实战精英班第二期</span></p>', 1, 2, 7, '2010-03-13', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');
INSERT INTO `joys_article` VALUES (13, '乐学PHP -实战精英班第三期', '2010-03-13-21-10-14', '乐学PHP三期', '<p><span style="font-size: medium">乐学PHP -实战精英班第一期</span></p>', 1, 2, 7, '2010-03-13', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', 0, '', '');


-- 
-- 导出表中的数据 `joys_component`
-- 

INSERT INTO `joys_component` VALUES (1, '文章内容', 'Article', 'view', 0, '', 1);
INSERT INTO `joys_component` VALUES (2, '单元内容', 'Section', 'view', 0, '', 1);
INSERT INTO `joys_component` VALUES (3, '分类内容', 'Category', 'view', 0, '', 1);


-- 
-- 导出表中的数据 `joys_menu`
-- 

INSERT INTO `joys_menu` VALUES (1, '主菜单', 'mainmenu', '主菜单');
INSERT INTO `joys_menu` VALUES (2, '导航菜单', 'topmenu', '导航菜单');


-- 
-- 导出表中的数据 `joys_menu_item`
-- 

INSERT INTO `joys_menu_item` VALUES (13, 'HTML基础', 1, 'html', 'index.php/Article/view/id/1', 'Article', 1, 0, '0', 1, 0, 0, 0, '');
INSERT INTO `joys_menu_item` VALUES (14, 'CSS基础', 1, 'css', 'index.php/Article/view/id/2', 'Article', 1, 0, '0', 1, 0, 0, 0, '');
INSERT INTO `joys_menu_item` VALUES (15, 'MySQL基础', 1, 'mysql', 'index.php/Article/view/id/3', 'Article', 1, 0, '0', 1, 0, 0, 0, '');
INSERT INTO `joys_menu_item` VALUES (17, 'PHP教程', 2, 'study', 'index.php/Section/view/id/1', 'Section', 1, 0, '0', 2, 0, 0, 0, '');
INSERT INTO `joys_menu_item` VALUES (18, 'PHP培训', 2, 'train', 'index.php/Section/view/id/2', 'Section', 1, 0, '0', 2, 0, 0, 0, '');
INSERT INTO `joys_menu_item` VALUES (19, 'PHP视频', 2, 'video', 'index.php/Section/view/id/3', 'Section', 1, 0, '0', 2, 0, 0, 0, '');
INSERT INTO `joys_menu_item` VALUES (20, 'PHP下载', 2, 'download', 'index.php/Section/view/id/4', 'Section', 1, 0, '0', 2, 0, 0, 0, '');
INSERT INTO `joys_menu_item` VALUES (21, 'PHP招聘', 2, 'job', 'index.php/Section/view/id/5', 'Section', 1, 0, '0', 2, 0, 0, 0, '');



-- 
-- 导出表中的数据 `joys_modules`
-- 

INSERT INTO `joys_modules` VALUES (1, '主菜单', '', 0, 'right', 1, 'Menu', 0, 1, 'id=1\nstyle=verticalmenu');
INSERT INTO `joys_modules` VALUES (2, '右侧菜单', '', 0, 'right', 1, 'Menu', 0, 1, 'id=2\nstyle=verticalmenu');
INSERT INTO `joys_modules` VALUES (3, '导航栏菜单', '', 0, 'top', 1, 'Menu', 0, 1, 'id=2\nstyle=rankmenu');
INSERT INTO `joys_modules` VALUES (4, '相关文章', '', 0, 'foot', 1, 'LatestNews', 0, 1, 'sid=1\ncid=1\nstyle=verticalmenu');
INSERT INTO `joys_modules` VALUES (5, '最新文章', '', 0, 'foot', 1, 'LatestNews', 0, 1, 'sid=2\ncid=7\nstyle=verticalmenu');


-- 
-- 导出表中的数据 `joys_modules_menu`
-- 

INSERT INTO `joys_modules_menu` VALUES (1, 0);
INSERT INTO `joys_modules_menu` VALUES (2, 0);
INSERT INTO `joys_modules_menu` VALUES (3, 0);
INSERT INTO `joys_modules_menu` VALUES (4, 0);
INSERT INTO `joys_modules_menu` VALUES (5, 0);


