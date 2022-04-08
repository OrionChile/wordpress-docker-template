<div class="video relative video_play overflow-hidden cursor-pointer" id="video">
	<a data-caption="video" data-fslightbox="fslightbox" href="<?php echo get_field('video_url', 9) ?>">
		<img class="bg_video w-full transition-all" src="<?php echo get_field('video_background', 9)['url'] ?>" alt="">
		<img class="w-32 icon_play absolute m-auto  transition-all top-0 bottom-0 left-0 right-0" src="<?php echo get_template_directory_uri() . '/images/icon_play.svg' ?>" alt="">
	</a>
</div>