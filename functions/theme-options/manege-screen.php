<div class="wrap">
    <h2>お客様情報</h2>



    <form method="post" action="options.php">

        <?php foreach (THEME_OPTIONS as $group_name => $options) : ?>


            <?php
            settings_fields($group_name);
            do_settings_sections($group_name);
            ?>


            <table class="form-table">

                <?php foreach ($options as $option) : ?>
                    <tr>
                        <th scope="row"><label for="<?= $option['key'] ?>"><?= $option['label'] ?></label></th>



                        <td>


                            <?php if ($option['type'] == 'text') : ?>

                                <input type="<?= $option['type'] ?>" name="<?= $option['key'] ?>" id="<?= $option['key'] ?>" value="<?= esc_attr(get_option($option['key'])) ?>" class="regular-text">

                            <?php elseif ($option['type'] == 'number') : ?>
                                <input type="<?= $option['type'] ?>" name="<?= $option['key'] ?>" id="<?= $option['key'] ?>" value="<?= esc_attr(get_option($option['key'])) ?>" class="regular-text">

                            <?php elseif ($option['type'] == 'eidtor') : ?>
                                <?php wp_editor(get_option($option['key']), $option['key']); ?>

                            <?php else : ?>

                            <?php endif; ?>


                        </td>


                    </tr>
                <?php endforeach; ?>

            </table>


        <?php endforeach; ?>



        <?php submit_button(); ?>

    </form>

</div>