<?php

CModule::AddAutoloadClasses(
	'nik.elementary',
	array(
		'Bitrix\Elementary\Helpers' => 'lib/helpers.php',
		'EventsLog' => 'lib/userfields/eventslog.php',
		'WhoCreate' => 'lib/userfields/whocreate.php',
	)
);