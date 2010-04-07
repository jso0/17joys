<?php

if (file_exists('installed.lock'))
    {
        echo '<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        </head>
        <body>
        你已经安装过该系统，如果想重新安装，请先删除install目录下的 installed.lock 文件，然后再安装。
        </body>
        </html>';
        exit;
    }

/*------------------------
初始化系统环境
------------------------*/
error_reporting(E_ALL & ~E_NOTICE);
define('ROOTDIR', substr(dirname(__FILE__), 0, -8));
//echo ROOTDIR;
define('ROOT', dirname(__FILE__));
$cfg_needFilter = false;
$cfg_isMagic = ini_get("magic_quotes_gpc");
if (!$cfg_isMagic)
{
    require_once ("includes/config_rglobals_magic.php");
}
else
{
    $cfg_registerGlobals = ini_get("register_globals");
    if (!$cfg_registerGlobals)
    {
        require_once ("includes/config_rglobals.php");
    }
}
if (empty ($step))
{
    $step = 1;
}
require_once ("includes/inc_install.php");
$gototime = 2000;

/*------------------------
显示协议文件
------------------------*/
if ($step == 1)
{
    
    include_once ("./templates/s1.html");
    exit ();
}

/*------------------------
测试环境要求
------------------------*/
else
    if ($step == 2)
    {
        $phpv = @ phpversion();
        $sp_os = $_ENV["OS"];
        $sp_gd = @ gdversion();
        $sp_server = $_SERVER["SERVER_SOFTWARE"];
        $sp_host = (empty ($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_HOST"] : $_SERVER["SERVER_ADDR"]);
        $sp_name = $_SERVER["SERVER_NAME"];
        $sp_max_execution_time = ini_get('max_execution_time');
        $sp_allow_reference = (ini_get('allow_call_time_pass_reference') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
        $sp_allow_url_fopen = (ini_get('allow_url_fopen') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
        $sp_safe_mode = (ini_get('safe_mode') ? '<font color=red>[×]On</font>' : '<font color=green>[√]Off</font>');
        $sp_gd = ($sp_gd > 0 ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
        $sp_mysql = (function_exists('mysql_connect') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');

        if ($sp_mysql == '<font color=red>[×]Off</font>')
            $sp_mysql_err = true;
        else
            $sp_mysql_err = false;

        $sp_testdirs = array ('/',
        					 '/Admin/Runtime/Cache',
        					 '/Admin/Runtime/Data',
        					 '/Admin/Runtime/Temp',
        					 '/Admin/Runtime/Logs',
        					 '/17Joys/Runtime/Cache',
        					 '/17Joys/Runtime/Data',
        					 '/17Joys/Runtime/Temp',
        					 '/17Joys/Runtime/Logs');
        include_once ("./templates/s2.html");
        exit ();
    }
    
/*------------------------
填写设置
------------------------*/
else
    if ($step == 3)
    {
        if (!empty ($_SERVER["REQUEST_URI"]))
        {
            $scriptName = $_SERVER["REQUEST_URI"];
        }
        else
        {
            $scriptName = $_SERVER["PHP_SELF"];
        }
        $rootpath = ereg_replace("/Install/index\.php(.*)$", "", $scriptName);
        if (empty ($_SERVER['HTTP_HOST']))
        {
            $domain = $_SERVER['HTTP_HOST'];
        }
        else
        {
            $domain = $_SERVER['SERVER_NAME'];
        }
        //$domain = eregi_replace('^www.', '', $domain);
        $rnd_cookieEncode = chr(mt_rand(ord('A'), ord('Z'))) . chr(mt_rand(ord('a'), ord('z'))) . chr(mt_rand(ord('A'), ord('Z'))) . chr(mt_rand(ord('A'), ord('Z'))) . chr(mt_rand(ord('a'), ord('z'))) . mt_rand(1000, 9999) . chr(mt_rand(ord('A'), ord('Z')));
        include_once ("./templates/s3.html");
        exit ();
    }    
    
/*------------------------
开始安装进程
------------------------*/

else
    if ($step == 5)
    {
        if (empty ($setupsta))
        {
            $setupsta = 0;
        }
        //初始化基本安装数据、创建表
        //----------------------------------
        if ($setupsta == 0)
        {
            $setupinfo = '';
            $gotourl = '';
            $gototime = 2000;
            /*
            if (eregi("[^\.0-9a-z@!_-]", $adminName) || eregi("[^\.0-9a-z@!_-]", $adminPwd)
            {
                echo GetBackAlert("管理员用户名或密码含有非法字符！");
                exit ();
            }
            */

            //检测数据库权限
            $conn = @ mysql_connect($dbHost, $dbUser, $dbPwd);
            if (!$conn)
            {
                echo GetBackAlert("数据库服务器或登录密码无效，\\n\\n无法连接数据库，请重新设定！");
                exit ();
            }
            $rs = mysql_select_db($dbName, $conn);
            if (!$rs)
            {
                $rs = mysql_query(" CREATE DATABASE `$dbName`; ", $conn);
                if (!$rs)
                {
                    $errstr = GetBackAlert("数据库 {$dbName} 不存在，也没权限创建新的数据库！");
                    echo $errstr;
                    exit ();
                }
                else
                {
                    $rs = mysql_select_db($dbName, $conn);
                    if (!$rs)
                    {
                        $errstr = GetBackAlert("你对数据库 {$dbName} 没权限！");
                        echo $errstr;
                        exit ();
                    }
                }
            }

            //读取配置模板，并替换真实配置
            $errstr = GetBackAlert("读取配置 _database.inc.php 失败，请检查#_database.inc.php是否可读取！");
            $fp = fopen(ROOT."/_database.inc.php", "r") or die($errstr);
            $strConfig = fread($fp, filesize(ROOT."/_database.inc.php"));
            fclose($fp);

            $strConfig = str_replace('~`~DBHOST~`~', $dbHost, $strConfig);
            $strConfig = str_replace('~`~DBUSER~`~', $dbUser, $strConfig);
            $strConfig = str_replace('~`~DBPWD~`~', $dbPwd, $strConfig);
            $strConfig = str_replace('~`~DBNAME~`~', $dbName, $strConfig);
            $strConfig = str_replace('~`~DBPORT~`~', $dbPort, $strConfig);
            $strConfig = str_replace('~`~DBPREFIX~`~', $dbPrefix, $strConfig);

            $errstr = GetBackAlert("写入配置 /config.inc.php 失败，请检查 /config.inc.php 文件夹是否可读写！");
            $fp = fopen(ROOTDIR."/config.inc.php", "w+") or die($errstr);
            flock($fp, 2);
            fwrite($fp, $strConfig);
            fclose($fp);

            //检测数据库信息并创建基本数据表
            mysql_query("SET NAMES 'UTF8';", $conn);
            $rs = mysql_query("SELECT VERSION();", $conn);
            $row = mysql_fetch_array($rs);
            $mysql_version = $row[0];
            $mysql_versions = explode(".", trim($mysql_version));
            $mysql_version = $mysql_versions[0] . "." . $mysql_versions[1];

            $adminPwd = MD5($adminPwd);

            $fp = fopen(ROOT . "/17joyscms.sql", "r");
            
            //创建数据表
            $query = "";
            while (!feof($fp))
            {
                $line = trim(fgets($fp, 512 * 1024));
                if (ereg(";$", $line))
                {
                    $query .= $line;
                    $query = str_replace('joys_', $dbPrefix, $query);
                    if ($mysql_version < 4.1)
                    {
                        mysql_query(str_replace('ENGINE=MyISAM  DEFAULT CHARSET=utf8', 'TYPE=MyISAM', $query), $conn);
                    }
                    else
                    {                        
                        mysql_query($query, $conn);
                    }

                    $query = '';
                }
                else
                {
                    if (!ereg("^(//|--)", $line))
                    {
                        $query .= $line;
                    }
                }
            }
            fclose($fp);

            //写入初始数据
            $fp = fopen(ROOT . "/data.sql", "r");
            $query = "";
            while (!feof($fp))
            {
                $line = trim(fgets($fp, 1024));
                if (ereg(";$", $line))
                {
                    $query .= $line;
                    $query = str_replace('17joys_', $dbPrefix, $query);
                    $query = str_replace('~`~ADMINNAME~`~', $adminName, $query);
                    $query = str_replace('~`~ADMINPWD~`~', $adminPwd, $query);
                    $query = str_replace('~`~SITENAME~`~', $siteName, $query);
                    $query = str_replace('~`~SITEURL~`~', $siteDomain, $query);
                    $query = str_replace('~`~SEOTITLE~`~', $siteName, $query);
                    $query = str_replace('~`~SEOKEYWORDS~`~', $siteKeywords, $query);
                    $query = str_replace('~`~SEODESCRIPTION~`~', $siteDescription, $query);
                    
                    mysql_query($query, $conn);

                    $query = '';
                }
                else
                {
                    if (!ereg("^(//|--)", $line))
                    {
                        $query .= $line;
                    }
                }
            }
            fclose($fp);
            mysql_close($conn);
            $setupmodules = '';
            if (is_array($moduls))
            {
                foreach ($moduls as $m)
                {
                    if (trim($m) != '')
                    {
                        $setupmodules .= ($setupmodules == '' ? $m : ",$m");
                    }
                }
            }

            $gotourl = 'index.php?step=5&setupsta=1';
            $setupinfo = "
            	    数据库安装成功。<br />开始安装模块，请稍候……<br />
            	    如果系统太长时间没有反应，请点击<a href='{$gotourl}'>这里</a>。
            	  ";
            include_once ("./templates/s4.html");
            exit ();
        }
        else
        {            
            $adminDir = 'admin.php'; 
            
            $fp = fopen('installed.lock', 'w+');
            fwrite($fp, 'ok');
            fclose($fp);
            $gototime = 3000;
            $gotourl = "../$adminDir/";
            $setupinfo = "
            	        已完成所有项目的安装。<br />
            	        现在转入管理员登录页面(<a href='{$gotourl}'>/$adminDir/Public/login</a>)，请稍候……<br />
            	        如果系统太长时间没有反应，请点击<a href='{$gotourl}'>这里</a>。
            	      ";
            include_once ("./templates/s4.html");
            exit ();
        }
    }
    
/*------------------------
检测数据库是否有效
------------------------*/
else
    if ($step == 10)
    {
        header("Pragma:no-cache\r\n");
        header("Cache-Control:no-cache\r\n");
        header("Expires:0\r\n");
        header("Content-Type: text/html; charset=utf-8");
        $conn = @ mysql_connect($dbHost, $dbUser, $dbPwd);
        if ($conn)
        {
            $rs = mysql_select_db($dbName, $conn);
            if (!$rs)
            {
                $rs = mysql_query(" CREATE DATABASE `$dbName`; ", $conn);
                if ($rs)
                {
                    mysql_query(" DROP DATABASE `$dbName`; ", $conn);
                    echo "<font color='green'>[√] 信息正确</font>";
                }
                else
                {
                    echo "<font color='red'>[×] 数据库不存在，也没权限创建新的数据库！</font>";
                }
            }
            else
            {
                echo "<font color='green'>[√] 信息正确</font>";
            }
        }
        else
        {
            echo "<font color='red'>[×] 数据库连接失败！</font>";
        }
        @ mysql_close($conn);
        exit ();
    }
?>