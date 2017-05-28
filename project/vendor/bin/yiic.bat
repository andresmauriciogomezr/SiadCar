@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../square1-io/yii-framework/yiic
php "%BIN_TARGET%" %*
