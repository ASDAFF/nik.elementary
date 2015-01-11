<?php

namespace Nik\Elementary;

use Bitrix\Main\Localization\Loc;


Loc::loadMessages(__FILE__);


class Helpers
{
    /**
     * Convert time in the nice view
     *
     * @param string $time Timestamp
     * @return string
     */
    public static function formattedTime($time)
    {
        $dateDiff = date_diff(date_create('now'), date_create(FormatDate('Y-m-d', $time)));

        if ($dateDiff->days === 0)
        {
            $formattedTime = Loc::getMessage('ELEMENTARY_TODAY').', '.date('H:i:s', $time);
        }
        elseif ($dateDiff->days === 1)
        {
            $formattedTime = Loc::getMessage('ELEMENTARY_YESTERDAY').', '.date('H:i:s', $time);
        }
        else
        {
            $formattedTime = FormatDate('FULL', $time);
        }

        return $formattedTime;
    }

    /**
     * Return array with events list and users
     *
     * @param int $iblockId Info-block ID
     * @param int $elementId Info-block element ID
     * @param int $limit Limit returned rows
     * @return array (EVENTS => array(), USERS => array())
     */
	public static function getEventsLog($iblockId, $elementId, $limit = 0)
    {
        $arEvents = array();
        $arUsersId = array();
        $arUsers = array();
        $limit = intval($limit);

        if ($limit > 0)
        {
            $rsEventsNav = array('nTopCount' => $limit);
        }
        else
        {
            $rsEventsNav = false;
        }

        $rsEvents = \CEventLog::GetList(
            array(
                'ID' => 'DESC'
            ),
            array(
                'MODULE_ID' => 'iblock',
                'ITEM_ID' => $iblockId
            ),
            $rsEventsNav
        );

        while ($arEvent = $rsEvents->Fetch())
        {
            $arEventDesc = unserialize($arEvent['DESCRIPTION']);

            if ($arEventDesc['ID'] === $elementId)
            {
                $arEvents[] = array_merge(
                    $arEvent,
                    array(
                        'DESCRIPTION' => $arEventDesc
                    )
                );
                
                $arUsersId[] = $arEventDesc['USER_ID'];
            }
        }

        if (!empty($arUsersId))
        {
            $rsUsers = \CUser::GetList(
                ($by = 'id'),
                ($order = 'asc'),
                array(
                    'ID' => $arUsersId
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
                $arUsers[$arUser['ID']] = $arUser;
            }
        }

        return array(
            'EVENTS' => $arEvents,
            'USERS' => $arUsers
        );
    }
}