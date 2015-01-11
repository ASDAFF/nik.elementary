<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Elementary\Helpers;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
CUtil::InitJSCore( array('jquery'));

$i = 0;
$previewRows = 10;
?>

<style>
    .events-list {
        width: 450px;
    }
    .events-list td.time {
        width: 130px;
    }
    .events-list td.user {
        width: 190px;
    }
    .events-list td.type {
        color: #999;
    }
    .events-list a.show-details {
        border-bottom: 1px dotted;
        color: #000;
        text-decoration: none;
    }
    .events-list td.details {
        display: none;
        padding: 4px 0 14px;
        font-size: 11px;
    }
    .events-list .hide {
        display: none;
    }
    .events-list .more-block {
        padding: 10px 0 8px;
        text-align: center;
        font-size: 12px;
    }
    .events-list .more-block a {
        text-decoration: none;
    }
    .events-list .more-block .turn {
        display: none;
    }
</style>

<?if (empty($arResult['EVENTS_LOG']['EVENTS'])) {?>

    <?=Loc::getMessage('ELEMENTARY_EVENTSLOG_EVENTS_LOG_EMPTY')?>
    <span id="hint_eventslog_empty"></span>
    <script>BX.hint_replace(BX('hint_eventslog_empty'), '<?=CUtil::JSEscape(Loc::getMessage("ELEMENTARY_EVENTSLOG_EVENTS_LOG_EMPTY_HINT"))?>');</script>

<?} else {?>

    <table class="events-list">

        <?foreach ($arResult['EVENTS_LOG']['EVENTS'] as $arEvent) {?>

            <?
            $arUser = $arResult['EVENTS_LOG']['USERS'][$arEvent['DESCRIPTION']['USER_ID']];

            switch ($arEvent['AUDIT_TYPE_ID'])
            {
                case 'IBLOCK_ELEMENT_ADD':
                    $eventType = 'ADD';
                break;

                default:
                    $eventType = 'EDIT';
                break;
            }

            $i++;
            ?>

            <tbody<?if ($i > $previewRows) echo ' class="hide"';?>>
                <tr>
                    <td class="time">
                        <?=Helpers::formattedTime(MakeTimeStamp($arEvent['TIMESTAMP_X'], 'DD.MM.YYYY HH:MI:SS'))?>
                    </td>
                    <td class="user">
                        <a href="user_edit.php?lang=ru&amp;ID=<?=$arUser['ID']?>">[<?=$arUser['ID']?>] (<?=$arUser['LOGIN']?>)</a>
                        <a href="#" class="show-details" title="<?=Loc::getMessage('ELEMENTARY_EVENTSLOG_DETAILS')?>"><?=$arUser['NAME']?> <?=$arUser['LAST_NAME']?></a>
                    </td>
                    <td class="type">
                        <?=Loc::getMessage('ELEMENTARY_EVENTSLOG_ELEMENT_'.$eventType)?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="details">
                        <b><?=Loc::getMessage('ELEMENTARY_EVENTSLOG_IP')?></b>: <?=$arEvent['REMOTE_ADDR']?><br>
                        <b><?=Loc::getMessage('ELEMENTARY_EVENTSLOG_USER_AGENT')?></b>: <?=$arEvent['USER_AGENT']?>
                    </td>
                </tr>
            </tbody>

        <?}?>

        <?if ($i > $previewRows) {?>
            <tbody>
                <tr>
                    <td colspan="3" class="more-block">
                        <div class="more">
                            <a href="#" class="toggle"><?=Loc::getMessage('ELEMENTARY_EVENTSLOG_MORE')?></a>
                        </div>
                        <div class="turn">
                            <a href="#" class="toggle"><?=Loc::getMessage('ELEMENTARY_EVENTSLOG_TURN')?></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        <?}?>

    </table>

    <script>
        $(function() {
            var $block = $('.events-list');
            $('.toggle', $block).on('click', function() {
                $('.hide', $block).animate({opacity: 'toggle'}, 500);
                $('.more, .turn', $block).animate({opacity: 'toggle'}, 100);
                return false;
            });
            $('.show-details', $block).on('click', function() {
                $(this).parent().parent().parent().find('.details').toggle();
                return false;
            });
        });
    </script>

<?}?>