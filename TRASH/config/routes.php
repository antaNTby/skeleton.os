<?php

foreach ( glob( __APP__ . '/routes/_*.php' ) as $fileName ) {
	require $fileName;
}