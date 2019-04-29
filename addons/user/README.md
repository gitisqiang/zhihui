# FastAdmin用户扩展插件

#### 插件介绍
基于FastAdmin的用户扩展

#### 使用说明
这是基于FastAdmin的用户端扩展插件。

1.新增框架用户端，有user模块和userend脚本，文件结构和功能类似于后台admin模块和backend脚本，便于进行用户端快速开发。 
2.新增user和user_rule表部分字段，修改相关记录，详见install.sql文件。 
3.新增用户日志功能。 
4.在application下新增三端（前端、后端、用户端）共用语言包，并修改语言包调用函数。 
5.新增application\common\library\UserMenu.php，用于user菜单管理。
6.如需启用用户日志功能，请在app\tags.php中添加标签代码，如： 
	// 应用结束 
	'app_end' => [ 
		'app\\user\\behavior\\UserLog', 
	], 
7.如需使用一键压缩JS的功能，请在`application/admin/command/Min.php`中第40行和49行分别加入`userend`
8.会员扩展会员中心地址为`/user/index`
