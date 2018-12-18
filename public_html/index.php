<?php
//require 'partials/scripts.php';
?>

<?php 
// Individual scripts. CONTROLLER == LOGIC
require 'controllers/' . $content; 
?>

<?php // VIEW == DISPLAY == TEMPLATE
// Shared html head.
require 'partials/head.php'; 
?>

<?php 
// Individual content.
require 'pages/' . $content; 
?>

<?php 
// Shared html footer.
require 'partials/footer.php'; 
?>