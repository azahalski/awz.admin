<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Awz\Admin\Access\AccessController;
use Awz\Admin\Access\Custom\ActionDictionary;

global $APPLICATION;
$dirs = explode(DIRECTORY_SEPARATOR, dirname(__DIR__, 1));
$module_id = array_pop($dirs);
unset($dirs);
Loc::loadMessages(__FILE__);

if(!Loader::includeModule($module_id)) return;

if(!AccessController::can(0, ActionDictionary::ACTION_GENS_PAGE))
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
global $POST_RIGHT;
$POST_RIGHT = 'W';

if(file_exists('check_awz_admin.php')){
    require_once('check_awz_admin.php');
}elseif(!Loader::includeModule('awz.admin')){
    return;
}

/* "Awz\Admin\AdminPages\GensList" replace generator */
use Awz\Admin\AdminPages\GensList as PageList;

$APPLICATION->SetTitle(PageList::getTitle());
$arParams = PageList::getParams();

include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/awz.admin/include/handler.php");
/* @var bool $customPrint */
if(!$customPrint) {
    $adminCustom = new PageList($arParams);
    $adminCustom->defaultInterface();
}