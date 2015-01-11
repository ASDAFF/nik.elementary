<?php

use Bitrix\Elementary\Helpers;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class EventsLog
{
    public function GetUserTypeDescription()
    {
        return array(
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'EVENTS_LOG',
            'DESCRIPTION' => Loc::getMessage('ELEMENTARY_EVENTSLOG_DESCRIPTION'),
            'GetPropertyFieldHtml' => array('EventsLog','GetPropertyFieldHtml'),
            'GetPropertyFieldHtmlMulty' => array('EventsLog','GetPropertyFieldHtmlMulty'),
            'GetSettingsHTML' => array('EventsLog','GetSettingsHTML')
        );
    }

    public function GetPropertyFieldHtmlMulty($arProperty, $value, $strHTMLControlName)
    {
        $arResult['EVENTS_LOG'] = Helpers::getEventsLog($arProperty['IBLOCK_ID'], intval($_REQUEST['ID']));

        include_once(__DIR__.'/templates/'.basename(__FILE__));
    }

    public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        $arResult['EVENTS_LOG'] = Helpers::getEventsLog($arProperty['IBLOCK_ID'], intval($_REQUEST['ID']), 1);

        include_once(__DIR__.'/templates/'.basename(__FILE__));
    }

    public function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
    {
        return false;
    }
}