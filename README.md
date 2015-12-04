# phalcon_manage
一个基于phlcon(2.0.8)及AceAdmin 的后台管理骨架


# 我的开发环境以及用到的库

- php>=5.4
- phalcon	2.0.8
- templateEngine	volt
- aceAdmin


# 网页工具或命令行工具
1. phalcon project projectName
2. cd project dir
3. create Module : phalcon module ModuleName
4. create Controller: phalcon controller ControllerName --module=ModuleName  (auto mv file to module directory)
5. create Model: phclcon model tableName --module=ModuleName --mapcolumn --trace
