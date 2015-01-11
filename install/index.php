<?php

IncludeModuleLangFile(__FILE__);

class nik_elementary extends CModule
{
    var $MODULE_ID = 'nik.elementary';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;
    
	function __construct()
	{
		$arModuleVersion = array();

		include(__DIR__.'/version.php');

		if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
		{
			$this->MODULE_VERSION = $arModuleVersion['VERSION'];
			$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		}

        $this->MODULE_NAME = GetMessage('ELEMENTARY_MODULE_NAME');
		$this->MODULE_DESCRIPTION = GetMessage('ELEMENTARY_MODULE_DESCRIPTION');

        $this->PARTNER_NAME = GetMessage('ELEMENTARY_PARTNER_NAME');
		$this->PARTNER_URI = GetMessage('ELEMENTARY_PARTNER_URI');
	}

	function DoInstall()
	{
        global $APPLICATION;

        $APPLICATION->IncludeAdminFile(GetMessage('ELEMENTARY_INSTALL_TITLE'), __DIR__.'/install.php');
	}

	function DoUninstall()
	{
        UnRegisterModule('nik.elementary');
        UnRegisterModuleDependences('iblock', 'OnIBlockPropertyBuildList', 'nik.elementary', 'Nik\Elementary\EventsLog', 'getUserTypeDescription');
        UnRegisterModuleDependences('iblock', 'OnIBlockPropertyBuildList', 'nik.elementary', 'Nik\Elementary\WhoCreate', 'getUserTypeDescription');
	}
}