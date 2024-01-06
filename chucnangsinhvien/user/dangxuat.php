<?php
    if (isset($_SESSION['sv'])) {
        unset($_SESSION['sv']);
        header('Location: index.php');
    }
?>