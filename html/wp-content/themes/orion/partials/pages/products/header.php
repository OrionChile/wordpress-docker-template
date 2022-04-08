<div class="header products2 relative">
	<div class="bgcont" style="z-index:-1">
		<img class="hidden md:block w-full" src="<?php echo get_field('header', $id)['url'] ?>" alt="">
		<img class="block md:hidden" src="<?php echo get_field('header_mobile', $id)['url'] ?>" alt="">
	</div>
	<div class=" absolute -bottom-3 left-0 right-0 flex justify-center items-center flex-col">
		<img class="logo w-44" src="<?php echo get_field('logo', $id)['url'] ?>" alt="">
		<div class="py-1 px-8 text-xs bg-primary text-white rounded-full mt-4"><?php echo get_the_title($id); ?></div>
	</div>
</div>