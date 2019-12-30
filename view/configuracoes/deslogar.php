<?php
session_start();
session_destroy();

header('location: /crud_php/index.php?msgDesl=1');
exit();
?>