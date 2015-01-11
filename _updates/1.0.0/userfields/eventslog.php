<?php

namespace Nik\Elementary;

use Bitrix\Main\Localization\Loc;


Loc::loadMessages(__FILE__);


class EventsLog
{
    public function getUserTypeDescription()
    {
        return array(
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'EVENTS_LOG',
            'DESCRIPTION' => Loc::getMessage('ELEMENTARY_EVENTSLOG_DESCRIPTION'),
            'GetPropertyFieldHtml' => array(__CLASS__, 'getPropertyFieldHtml'),
            'GetPropertyFieldHtmlMulty' => array(__CLASS__, 'getPropertyFieldHtmlMulty'),
            'GetSettingsHTML' => array(__CLASS__, 'getSettingsHTML')
        );
    }

    public function getPropertyFieldHtmlMulty($arProperty, $value, $strHTMLControlName)
    {
        $arResult['EVENTS_LOG'] = Helpers::getEventsLog($arProperty['IBLOCK_ID'], intval($_REQUEST['ID']));

        include_once(__DIR__.'/templates/'.basename(__FILE__));
    }

    public function getPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        $arResult['EVENTS_LOG'] = Helpers::getEventsLog($arProperty['IBLOCK_ID'], intval($_REQUEST['ID']), 1);

        include_once(__DIR__.'/templates/'.basename(__FILE__));
    }

    public function getSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
    {
        return false;
    }
}