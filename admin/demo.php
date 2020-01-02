<?php
$date=date_create(date("Y-m-d"));
date_sub($date,date_interval_create_from_date_string("2 days"));
echo date_format($date,"Y-m-d");
?>