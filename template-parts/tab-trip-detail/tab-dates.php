<?php

//do_action( 'lds_travel_include_module','departure-dates','');

//$pid = $_POST['post_id'];
$pid = get_the_ID();
//dates description
// $journey = getJourney('date_description', $pid = get_the_ID());
// echo $journey->date_description;
echo get_field('date_description',  get_the_ID());
?>
 <!-- //check the slug of new date post -->
    <?php
        //check the slug of new date post
        $post_slug = get_post_field( 'post_name', get_post() ); 
        //var_dump($post_slug);
        $args = array(
            'post_type' => 'tripdates',
             'name' =>$post_slug,
        );
        $trip_posts = array();
        $loop = new WP_Query($args);
        while($loop->have_posts()): $loop->the_post();
            $p_id = get_the_ID();
         wp_reset_postdata();
        endwhile;
        //var_dump($p_id);
    ?>
    <div style="display: none;"><?php //echo $p_id;?></div>
<div class="tab-date-content">
    <div id="date-row"></div>
    <section class="tab-journey-type">

        <ul class="nav nav-tabs">

           <?php 
                $class = "active";
                if (    have_rows('small_group_journey', $pid) ||
                        have_rows('group_size_info', $pid) ||
                        get_field('small_group', $pid)
                    )
                {
                    $tab_small = "active";
                    
            ?> 
                <li class="<?php echo $class; ?>"><a href="#small-group" data-toggle="tab">Small Group Journey</a></li>
            <?php $class=''; } ?>
           <?php if(get_field('private_journey', $pid)) { ?> 
                <li class="<?php echo $class; ?>">
                <a href="#private-journey" data-toggle="tab">Private Journey</a></li>
            <?php 
                $class='';
                if (    !have_rows('small_group_journey', $pid) &&
                        !have_rows('group_size_info', $pid) && 
                        !get_field('small_group', $pid)
                    )
                {
                    $tab_private="active"; 
                }
            } ?>
            <?php if(get_field('tailor_made_journey', $pid)) { ?> 
                <li class="<?php echo $class; ?>"><a href="#tailor-made" data-toggle="tab">Tailor made Journey</a></li>
            <?php 
                $class='';  
                 if (   !have_rows('small_group_journey', $pid) &&
                        !have_rows('group_size_info', $pid) && 
                        !get_field('small_group', $pid) &&
                        !get_field('private_journey', $pid)
                    )
                {
                    $tab_tailor="active"; 
                }

            } ?>
        </ul>
        <ul class="tab-content clearfix">
            <div style="display: none;">
                    <?php  if (have_rows('new_small_group_journey', $p_id)) {
                          $arr_dateS = array();
                            while (have_rows('new_small_group_journey', $p_id)):the_row();
                            $dateS =  explode('-', get_sub_field('new_start_dateend_date'));
                            $arr_dateS[] = $dateS;
                            endwhile;
                            echo "1 ";
                           var_dump($arr_dateS); // 
                        }else{
                        if(have_rows('small_group_journey', $pid)){?> 
                        <?php 
                          $arr_dateS = array();
                            while (have_rows('small_group_journey', $pid)):the_row();
                            $dateS =  explode('-', get_sub_field('start_date/end_date'));
                            $arr_dateS[] = $dateS;
                            endwhile;
                           var_dump($arr_dates); // 
                        }
                    }?> 
                    </div>
            <?php  $journey_small_group = get_field('small_group', $pid);?>
            <?php if (have_rows('small_group_journey', $pid) || have_rows('group_size_info', $pid ) || $journey_small_group) { ?>
                <li class="tab-pane <?php echo $tab_small; ?>" id="small-group">
                    <?php
                    //small journey
                    //$journey = getJourney('small_group', $pid);
                    //$journey = get_field('small_group', $pid);
                    echo $journey_small_group;
                    ?>

                <!--group discount price-->
                <?php if( have_rows('group_discount') ): ?>
                        <div class="clearfix discount-list-wrap<?php if (have_rows('small_group_journey', $pid)) { echo ' hide-list'; } ?>">
                            <h3 class="group-discount">See Group Discount</h3>
                            <div class="discount-list">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>No. of people</th>
                                        <th>Price per person</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php while( have_rows('group_discount') ): the_row();
                                        $group_range = get_sub_field('group_range');
                                        $group_price = get_sub_field('price_per_person'); ?>
                                        <tr>
                                            <td><?php echo $group_range; ?></td>
                                            <td><?php echo 'USD '.number_format($group_price); ?></td>
                                        </tr>
                                    <?php endwhile; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                <?php endif; ?>
                <!--end of group discount price-->
                
                <?php 
                //
                /**
                 * add departure date module 
                 */

                do_action( 'lds_travel_include_module','departure-dates',''); ?>
            </li>
            <?php } ?>
            <li class="tab-pane <?php echo $tab_private; ?>" id="private-journey">
                <?php
                $list_date = array();
                // $journey = getJourney('private_journey', $pid);
                // echo $journey->private_journey;
                $journey = get_field('private_journey', $pid);
                echo $journey;
                $trip_title = get_the_title(get_the_ID());
                ?>
                <?php echo do_shortcode('[gravityform id="8" title="false" description="false" ajax="true" tabindex="79" field_values="trip_name='.$trip_title.'"]'); ?>
            </li>
            <li class="tab-pane <?php echo $tab_tailor; ?>" id="tailor-made">
                <?php
                 // $journey = getJourney('tailor_made_journey', $pid);
                // echo $journey->private_journey;
                $journey = get_field('tailor_made_journey', $pid);
                echo $journey;
                ?>
                <?php echo do_shortcode('[gravityform id="9" title="false" description="false" ajax="true" tabindex="69" field_values="trip_name='.$trip_title.'"]'); ?>
            </li>

        </ul>
    </section>

</div>
