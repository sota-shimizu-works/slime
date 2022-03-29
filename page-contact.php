<?php get_header(); ?>

<?php $form = new ContactForm(); ?>
<?= $form->creatForm() ?>
<input type="text" name="test">
<?= $form->send() ?>
<?= $form->endForm() ?>

<?php get_footer(); ?>