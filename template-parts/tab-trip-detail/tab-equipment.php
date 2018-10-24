<?php //$pid = $_POST['post_id']; ?>
<?php $pid = get_the_ID(); ?>
<div class="tab-equipment-content">
    <?php the_field("equipment_main_description", $pid); ?>
    <?php if (have_rows('equipment_description', $pid)):
        while (have_rows('equipment_description', $pid)):the_row();
            ?>
            <h4 class="section__heading"><?php the_sub_field("title"); ?></h4>
            <?php the_sub_field("description"); ?>

        <?php endwhile;
    endif;
    if(get_field('equipment_extra_description', $pid)) {
    ?>
    <div class="equipment-extra-description"><?php the_field("equipment_extra_description",$pid) ?></div>
    <?php } ?>
</div>