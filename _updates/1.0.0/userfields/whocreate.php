<?php

namespace Nik\Elementary;

use Bitrix\Main\Localization\Loc;


Loc::loadMessages(__FILE__);


class WhoCreate
{
    public function getUserTypeDescription()
    {
        return array(
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'WHO_CREATE',
            'DESCRIPTION' => Loc::getMessage('ELEMENTARY_WHOCREATE_DESCRIPTION'),
            'GetPropertyFieldHtml' => array(__CLASS__, 'getPropertyFieldHtml'),
            'GetPropertyFieldHtmlMulty' => array(__CLASS__, 'getPropertyFieldHtmlMulty'),
            'GetSettingsHTML' => array(__CLASS__, 'getSettingsHTML'),
            'ConvertToDB' => array(__CLASS__, 'convertToDB'),
            'ConvertFromDB' => array(__CLASS__, 'convertFromDB')
        );
    }

    public function getPropertyFieldHtmlMulty($arProperty, $value, $strHTMLControlName)
    {
        static::getFieldHtml($arProperty);
    }

    public function getPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        static::getFieldHtml($arProperty);
    }

    public function getSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
    {
        return false;
    }

    public function convertFromDB($arProperty, $value)
    {
        return $value;
    }

    public function convertToDB($arProperty, $value)
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