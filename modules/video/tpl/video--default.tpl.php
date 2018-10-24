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
<div class="video-container">
    <div class="video-poster" style="background: url(<?php echo $data['video_img']; ?>) no-repeat center center; background-size: cover;"></div>
    <div id="module-video" class="module-video"></div>
    <div class="video-content" data-video-id="<?php echo $data['youtube_video_id']; ?>">
        <?php if($data['video_section_title']){ ?><h2><?php echo $data['video_section_title']; ?></h2><?php } ?>
        <?php if($data['youtube_video_description']){ ?><p><?php echo $data['youtube_video_description']; ?></p><?php } ?>
        <a href="https://www.youtube.com/embed/<?php echo $data['youtube_video_id']; ?>?autoplay=0" class="fancybox-video">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="play-button"><g fill="#FFFFFF">
            <path d="M10 0C4.5 0 0 4.5 0 10 0 15.5 4.5 20 10 20 15.5 20 20 15.5 20 10 20 4.5 15.5 0 10 0L10 0ZM8 14.5L8 5.5 14 10 8 14.5 8 14.5Z"/></g>
            </svg>
        </a>
    </div>
</div>
<?php endif;?>