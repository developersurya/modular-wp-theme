var video_id = jQuery('#module-video').data('video-id');
jQuery('#module-video').YTPlayer({
    fitToBackground: false,
    videoId: video_id,
    pauseOnScroll: false,
    playerVars: {
        modestbranding: 0,
        autoplay: 1,
        showinfo: 0,
        branding: 0,
        autohide: 0
    }
});