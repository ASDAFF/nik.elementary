<?php

use Bitrix\Elementary\Helpers;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class WhoCreate
{
    public function GetUserTypeDescription()
    {
        return array(
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'WHO_CREATE',
            'DESCRIPTION' => Loc::getMessage('ELEMENTARY_WHOCREATE_DESCRIPTION'),
            'GetPropertyFieldHtml' => array('WhoCreate','GetPropertyFieldHtml'),
            'GetPropertyFieldHtmlMulty' => array('WhoCreate','GetPropertyFieldHtmlMulty'),
            'GetSettingsHTML' => array('WhoCreate','GetSettingsHTML'),
            'ConvertToDB' => array('WhoCreate','ConvertToDB'),
            'ConvertFromDB' => array('WhoCreate','ConvertFromDB')
        );
    }

    public function GetPropertyFieldHtmlMulty($arProperty, $value, $strHTMLControlName)
    {
        static::getFieldHtml($arProperty);
    }

    public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        static::getFieldHtml($arProperty);
    }

    public function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
    {
        return false;
    }

    public function ConvertFromDB($arProperty, $value)
    {
        return $value;
    }

    public function ConvertToDB($arProperty, $value)
    {
        return $value;
    }

    protected function getFieldHtml($arProperty)
    {
        $rsElement = CIBlockElement::GetByID(intval($_REQUEST['ID']));
        $arResult['ELEMENT'] = $rsElement->Fetch();

        $rsUsers = \CUser::GetList(
            ($by = 'id'),
            ($order = 'asc'),
            array(
                'ID' => $arResult['ELEMENT']['MODIFIED_BY'].' | '.$arResult['ELEMENT']['CREATED_BY']
            ),
            array(
                'FIELDS' => array(
                    'ID',
                    'LOGIN',
                    'NAME',
                    'LAST_NAME'
                )
            )
        );

        while ($arUser = $rsUsers->Fetch())
        {
            $arResult['USERS'][$arUser['ID']] = $arUser;
        }

        include_once(__DIR__.'/templates/'.basename(__FILE__));
    }
}