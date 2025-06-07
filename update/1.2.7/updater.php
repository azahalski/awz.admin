<?
$moduleId = "awz.admin";
if(IsModuleInstalled($moduleId)) {
    $updater->CopyFiles("install/components","components");
    $updater->CopyFiles("install/panel","panel");
}