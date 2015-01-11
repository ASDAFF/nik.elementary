<?php

$modulePath = $_SERVER['DOCUMENT_ROOT'].getLocalPath('modules/nik.elementary');

DeleteDirFilesEx($modulePath.'/lib/userfields');
DeleteDirFilesEx($modulePath.'/lang/ru/lib/userfields');
DeleteDirFilesEx($modulePath.'/lang/en/lib/userfields');