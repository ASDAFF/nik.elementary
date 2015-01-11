<?php

if (!check_bitrix_sessid())	return false;


if (version_compare(SM_VERSION, '14.0.0') < 0)
{
    CAdminMessage::ShowMessage(
        array(
            'TYPE' => 'ERROR',
            'MESSAGE' => GetMessage('ELEMENTARY_INSTALL_ERROR_BITRIX_VERSION_TITLE'),
            'DETAILS' => GetMessage('ELEMENTARY_INSTALL_ERROR_BITRIX_VERSION_MESSAGE'),
            'HTML' => true
        )
    );

    ?>
    <div style="margin-top: 20px;">
        <input onclick="location.href='update_system.php?lang=<?=LANGUAGE_ID?>'" type="submit" class="adm-btn-save" value="<?=GetMessage('ELEMENTARY_INSTALL_LINK_BITRIX_UPDATE')?>">
        <input onclick="location.href='<?=$APPLICATION->GetCurPage()?>?lang=<?=LANGUAGE_ID?>'" type="submit" value="<?=GetMessage('ELEMENTARY_INSTALL_LINK_BACK_SOLUTIONS')?>">
    </div>
    <?
}
else
{
    RegisterModule('nik.elementary');
    RegisterModuleDependences('iblock', 'OnIBlockPropertyBuildList', 'nik.elementary', 'EventsLog', 'GetUserTypeDescription');
    RegisterModuleDependences('iblock', 'OnIBlockPropertyBuildList', 'nik.elementary', 'WhoCreate', 'GetUserTypeDescription');

    CAdminMessage::ShowNote(GetMessage('ELEMENTARY_INSTALL_COMPLETE_TITLE'));
    echo GetMessage('ELEMENTARY_INSTALL_COMPLETE_MESSAGE');

    ?>
    <div style="margin-top: 20px;">
        <input onclick="location.href='<?=$APPLICATION->GetCurPage()?>?lang=<?=LANGUAGE_ID?>'" type="submit" value="<?=GetMessage('ELEMENTARY_INSTALL_LINK_BACK_SOLUTIONS')?>" />
    </div>
    <?
}