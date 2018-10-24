<?php
//$pid = $_POST['post_id'];
$pid = get_the_ID();

if (have_rows('day_to_day_itinerary',$pid)):
    while (have_rows('day_to_day_itinerary',$pid)):the_row();
        ?>

        <div class="itinerary--item">
            <h6><?php the_sub_field("title"); ?></h6>

            <?php the_sub_field("description"); ?>
        </div>
        <?php
    endwhile;
endif; ?>