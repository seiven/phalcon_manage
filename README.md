# phalcon_manage
a manage system on phalcon

# environment
- php>=5.4
- phalcon	2.0.8
- templateEngine	volt
- aceAdmin


# webtools and clitool
1. phalcon project projectName
2. cd project dir
3. create Module : phalcon module ModuleName
4. create Controller: phalcon controller ControllerName --module=ModuleName  (auto mv file to module directory)
5. create Model: phclcon model tableName --module=ModuleName --mapcolumn --trace
