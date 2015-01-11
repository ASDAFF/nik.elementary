<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Elementary\Helpers;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arUserCreate = $arResult['USERS'][$arResult['ELEMENT']['CREATED_BY']];
$arUserModified = $arResult['USERS'][$arResult['ELEMENT']['MODIFIED_BY']];
?>

<style>
    .whocreate-list table {
        width: 470px;
    }
    .whocreate-list td.time {
        width: 130px;
    }
    .whocreate-list td.user {
        width: 190px;
    }
    .whocreate-list td.type {
        color: #999;
    }
</style>

<table class="whocreate-list">

	<?if ($arResult['ELEMENT']['TIMESTAMP_X_UNIX']) {?>
		<tr>
			<td class="time">
				<?=Helpers::formattedTime($arResult['ELEMENT']['TIMESTAMP_X_UNIX'])?>
			</td>
			<td class="user">
				<a href="user_edit.php?lang=ru&amp;ID=<?=$arUserModified['ID']?>">[<?=$arUserModified['ID']?>] (<?=$arUserModified['LOGIN']?>)</a> <?=$arUserModified['NAME']?> <?=$arUserModified['LAST_NAME']?>
			</td>
			<td class="type">
				<?=Loc::getMessage('ELEMENTARY_WHOCREATE_EDITED')?>
			</td>
		</tr>
	<?}?>

	<?if ($arResult['ELEMENT']['DATE_CREATE_UNIX']) {?>
		<tr>
			<td class="time">
				<?=Helpers::formattedTime($arResult['ELEMENT']['DATE_CREATE_UNIX'])?>
			</td>
			<td class="user">
				<a href="user_edit.php?lang=ru&amp;ID=<?=$arUserCreate['ID']?>">[<?=$arUserCreate['ID']?>] (<?=$arUserCreate['LOGIN']?>)</a> <?=$arUserCreate['NAME']?> <?=$arUserCreate['LAST_NAME']?>
			</td>
			<td class="type">
				<?=Loc::getMessage('ELEMENTARY_WHOCREATE_CREATED')?>
			</td>
		</tr>
	<?} else {?>
		<script>
			var propertyRow = document.getElementById("tr_PROPERTY_<?=$arProperty['ID']?>");
			if (propertyRow) {
				propertyRow.remove();
			}
		</script>
	<?}?>

</table>