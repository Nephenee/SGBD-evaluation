<?php
    if(isset($_SESSION['user'])): ?>

    Hello world

<?php else:
    header("Location: /");
    exit;
    endif;
?>

