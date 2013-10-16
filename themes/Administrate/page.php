<?php

// Page.php
// Main page template
	get_header();

?>

<div class="article-container">
	<article>
		<h2><?php get_pageTitle(); ?></h2>
		<?php get_pageContent(); ?>
	</article>
</div>

<?php
	get_footer();
?>