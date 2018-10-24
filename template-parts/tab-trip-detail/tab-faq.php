<?php 
//$pid = $_POST['post_id'];
$pid = get_the_ID();
$faqs_list = get_field('faqs_list',$pid);
//var_dump($faqs_list[0]->ID);
?>
<?php 
//??? can we add it in faq post type
//if(get_field('faqs_tab_title','options')){ ?>
    <h4 class="section__heading">Here's a few answers to most common Questions asked by the customers.
        <?php //echo get_field('faqs_tab_title','options'); ?></h4> 
    <?php //} ?>
<div class="panel-group faq-accordion" id="accordion">
    <?php
    $count = 0;
    if (have_rows('faqs_list',$faqs_list[0]->ID)):
        while (have_rows('faqs_list',$faqs_list[0]->ID)):the_row();

            ?>
            <div class="panel">
                <div class="panel-heading">
                    <h6>
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"
                           href="#collapse<?php echo $count; ?>">
                           <?php the_sub_field("question"); ?>
                        </a>
                    </h6>
                </div>
                <div id="collapse<?php echo $count; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php the_sub_field("answer"); ?>
                    </div>
                </div>
            </div>
            <?php
            $count++;
        endwhile;
    endif;
    ?>

</div>