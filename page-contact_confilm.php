<?php get_header(); ?>

<?php $form = new ContactForm(); ?>
<?= $form->creatForm() ?>
<?= $form->send() ?>
<?= $form->endForm() ?>

<?php get_footer(); ?>
