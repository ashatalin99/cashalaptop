<?php  
get_template_part('partials/head');
?>
<body <?php body_class(); ?>>
	<?php 
		do_action('get_header');
		get_main_header();
	?>
	
	<main>
		<?php get_main_template(); ?>
	</main>

	<?php
		do_action('get_footer');
		get_main_footer();
	?>
</body>
</html>