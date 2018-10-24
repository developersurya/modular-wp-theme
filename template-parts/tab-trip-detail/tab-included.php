<?php //$pid = $_POST['post_id']; ?>
<?php $pid = get_the_ID(); ?>
<div class="tab-included-content">
    <?php if(get_field("include_description", $pid)){ ?>
        <div class="include_note">
        <?php the_field("include_description", $pid) ?>
    </div><!-- .include_note -->
    <?php } 
    if (have_rows('cost_includes')) {
        ?>
        <h4 class="section__heading">Price Includes</h4>
        <ul class="clearfix cost-included">
        <?php while (have_rows('cost_includes', $pid)) {
            the_row(); ?>
                <li><span class="icon-included"></span><p><?php the_sub_field("included", $pid); ?> </p></li>
        <?php } ?>
        </ul>
   <?php } ?>

    <?php if (have_rows('excludes',$pid)):?>
    <h4 class="section__heading">Price Does not Include</h4>

        <ul class="clearfix">
            <?php
            while (have_rows('not_include',$pid)):the_row(); ?>
                <li><span class="icon-cross"></span><p><?php the_sub_field("excluded",$pid); ?></p></li>
            <?php endwhile; ?>
        </ul>
        <?php the_field("excludes",$pid); ?>
        <?php
    endif; ?>

<!--exclude-->
     <?php if (get_field('excludes',$pid)):
        ?>
    <h4 class="section__heading">Price Does not Include</h4>
        
        <?php the_field("excludes",$pid); ?>
        <?php
    endif; ?>
<!--exclude-->

    <div style="margin-top:20px;">
        <?php the_field("include_exclude_note", $pid) ?>
    </div>
</div>