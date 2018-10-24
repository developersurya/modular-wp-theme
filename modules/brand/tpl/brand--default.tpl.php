<?php 
/**
 * This file contains view part only (HTML) and should NOT contain database related queries
 * #use var_dump($data); to check all available data
 * #use $data['acf_field_name'] to get each field inside loop 
 * #use $data['post_id'] to get default post id and use it in wp function e.g get_the_content($_data['post_id'])
 */
//check what we have in data
//var_dump($data);
 ?>
<?php if (!empty($data)): ?>
<div class="site-branding">
    <a class="logo" href="<?php echo site_url(); ?>">
    <img src="<?php echo $data['site_logo'] ;?>" alt="Acethehimalaya logo"></a>
    <img class="ace-slogan" src="<?php echo $data['ace_slogan'] ;  ?>" alt="Acethehimalaya Slogan">
</div>
<?php endif;?>