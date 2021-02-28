<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


include_once dirname(__FILE__) . '/' . 'components/utils/system_utils.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('Europe/Minsk');

function GetGlobalConnectionOptions()
{
    return array(
  'server' => 'localhost',
  'port' => '3306',
  'username' => 'root',
  'password' => 'mynewpassword',
  'database' => 'plumbers'
);
}

function HasAdminPage()
{
    return true;
}

function GetPageGroups()
{
    $result = array('Default');
    return $result;
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'Banner', 'short_caption' => 'Banner', 'filename' => 'banner.php', 'name' => 'banner', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Contact', 'short_caption' => 'Contact', 'filename' => 'contact.php', 'name' => 'contact', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Page', 'short_caption' => 'Page', 'filename' => 'page.php', 'name' => 'page', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Product', 'short_caption' => 'Product', 'filename' => 'product.php', 'name' => 'product', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Project', 'short_caption' => 'Project', 'filename' => 'project.php', 'name' => 'project', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Section', 'short_caption' => 'Section', 'filename' => 'section.php', 'name' => 'section', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Service', 'short_caption' => 'Service', 'filename' => 'service.php', 'name' => 'service', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Social', 'short_caption' => 'Social', 'filename' => 'social.php', 'name' => 'social', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Subscriber', 'short_caption' => 'Subscriber', 'filename' => 'subscriber.php', 'name' => 'subscriber', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Tb News', 'short_caption' => 'Tb News', 'filename' => 'tb_news.php', 'name' => 'tb_news', 'group_name' => 'Default', 'add_separator' => false);
    return $result;
}

function GetPagesHeader()
{
    return
    '';
}

function GetPagesFooter()
{
    return
        ''; 
    }

function ApplyCommonPageSettings(Page $page, Grid $grid)
{
    $page->SetShowUserAuthBar(true);
    $page->OnCustomHTMLHeader->AddListener('Global_CustomHTMLHeaderHandler');
    $page->OnGetCustomTemplate->AddListener('Global_GetCustomTemplateHandler');
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
}

/*
  Default code page: 1252
*/
function GetAnsiEncoding() { return 'windows-1252'; }

function Global_CustomHTMLHeaderHandler($page, &$customHtmlHeaderText)
{

}

function Global_GetCustomTemplateHandler($part, $mode, &$result, &$params, Page $page = null)
{

}

function Global_BeforeUpdateHandler($page, &$rowData, &$cancel, &$message, $tableName)
{

}

function Global_BeforeDeleteHandler($page, &$rowData, &$cancel, &$message, $tableName)
{

}

function Global_BeforeInsertHandler($page, &$rowData, &$cancel, &$message, $tableName)
{

}

function GetDefaultDateFormat()
{
    return 'Y-m-d';
}

function GetFirstDayOfWeek()
{
    return 0;
}

function GetEnableLessFilesRunTimeCompilation()
{
    return false;
}



?>