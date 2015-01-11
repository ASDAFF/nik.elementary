<?php

\Bitrix\Main\Loader::registerAutoLoadClasses(
    'nik.elementary',
    array(
        'Nik\Elementary\Helpers' => 'lib/helpers.php',
        'Nik\Elementary\EventsLog' => 'userfields/eventslog.php',
        'Nik\Elementary\WhoCreate' => 'userfields/whocreate.php'
    )
);