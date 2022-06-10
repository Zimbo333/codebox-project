<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blossom_Theme
 */

get_header();
?>

<main id="primary" class="site-main"  style="background: linear-gradient(to bottom right,#0006,#0009),url('https://wordpress-381645-2382470.cloudwaysapps.com/wp-content/uploads/2022/05/photo-1515879218367-8466d910aaa4.jpeg')">
	<div class="container mx-auto py-20 text-center noto" style="min-height: calc(100vh - 76px - 56px);display: flex;justify-content: center;align-items: center;color: #fff;text-align: center;">
		<div>
			<h1 class="text-5xl mb-20 mono">Welcome to Codebox</h1>
			<div class="text-center">
				<a href="/new-code" class="text-xl rounded-md border-slate-200 px-3 py-2 text-sm- mr-2 bg-pink-600 hover:bg-pink-700 border-2 border-pink-600 hover:border-pink-700  text-white font-bold mono">Start Coding</a>
			</div>
		</div>
	</div>


</main><!-- #main -->

<?php
get_footer();
