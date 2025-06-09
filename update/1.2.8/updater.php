<?
$moduleId = "awz.admin";
if(IsModuleInstalled($moduleId)) {
    $updater->CopyFiles("install/js","js");
}