<?php get_header(); ?>

<?php

for ($i = 0; $i < 5; $i++) {
    debug($i, 'group');
}

$ary = ['Im Sota.', 'I LOVE WordPress! 😘'];
debug($ary);
debug('debug-kit');
debug(12);

?>

<?php get_footer(); ?>