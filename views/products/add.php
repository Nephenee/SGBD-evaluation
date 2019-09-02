<?php
    $_SESSION['user']['role'] = 'admin';
    if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>

    Hello admin

<?php else:
    header("Location: /");
    exit;
    endif;
?>

