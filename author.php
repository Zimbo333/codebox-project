<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blossom_Theme
 */

get_header();
$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
$author_id = $author->ID;
$author_pic = get_avatar_url($author_id, array("size"=>260));
$args = array(
	'post_type' => 'code',
	'post_status' => 'publish',
	'posts_per_page' => -1,
					// 'posts_per_page' => 12,
					// 'offset' => 0,
	'author' => $author_id
);
$posts = new WP_Query( $args );
$postsCount = $posts->post_count;
?>

<main id="primary" class="site-main">

	<!--=== The Section Boxes : author_bio ===-->
	<section id="author_bio" class="py-10 bg-slate-100 ">
		<div class="container mx-auto">
			<div id="author_bio_header">
				<div class="author-pic-wrap">
					<div class="author-pic-df aspect-square">
						<div class="author-pic aspect-square" style="background-image:url('<?=$author_pic?>')"></div>
					</div>
				</div>
				<div class="author-bio-wrap">
					<div class="author-bio-info">
						<h1 class="noto text-4xl font-bold text-pink-500 mb-2"><?=$author->display_name?></h1>
						
						<h5 class="mono"><span class="icon-wrap"><i class="fas fa-keyboard"></i></span> <?=$postsCount?> CodeBoxes</h5>
						<h5 class="mono"><span class="icon-wrap"><i class="fas fa-code-branch"></i></span> 8 Branches</h5>
						<!-- <h5 class="mono"><span class="icon-wrap"><i class="fas fa-graduation-cap"></i></span> 1 Enrolled Courses</h5> -->
					</div>
				</div>
			</div>
		</div>
	</section>


	
	<section id="author_code" class="padding-l-vtc">
		<div id="units" class="bg-slate-50 py-8 pb-8">
			<div class="container mx-auto">
				<h2 class="text-3xl font-bold mb-6 text-slate-600">
					<i class="fas fa-keyboard mr-2"></i>
					Boxes
				</h2>
				<?php 
				if ($postsCount>0) {
					echo '<div class="box-wrap">';
					foreach ($posts->posts as $key => $b) {
						// pre($b);
						?>
						<div class="box-item mb-2" id="box_<?=$b->ID?>">
							<div class="bg-white rounded border-pink-400	border-2 mb-2">
								<div class="box-iframe-wrap">
									<iframe src="<?=get_permalink($b)?>/?preview" class="box-iframe" sandbox="allow-modals allow-pointer-lock allow-presentation allow-same-origin allow-scripts"></iframe>
								</div>
							</div>
							<h3>
								<a href="<?=get_permalink($b)?>" class="font-bold text-slate-600 hover:text-slate-400"><?=$b->post_title?></a>
							</h3>
							<h4 class="text-pink-600 text-sm"><?=get_the_date( $d = 'j F Y - g:i A', $b )?></h4>
							
						</div>
						<?php
					}
					echo '</div>';
				}else{
					echo 'Nothing.';
				}
				wp_reset_query();
				?>
			</div>
		</div>
	</section>

	<section id="author_branch" class="padding-l-vtc">
		<div id="units" class="bg-slate-50 py-8 pb-8">
			<div class="container mx-auto">
				<h2 class="text-3xl font-bold mb-6 text-slate-600">
					<i class="fas fa-code-branch mr-2"></i>
					Branches
				</h2>
				<?php 
				if ($postsCount>0) {
					echo '<div class="box-wrap">';
					foreach ($posts->posts as $key => $b) {
						// pre($b);
						?>
						<div class="box-item mb-2" id="box_<?=$b->ID?>">
							<div class="bg-white rounded border-yellow-400	border-2 mb-2">
								<div class="box-iframe-wrap">
									<iframe src="<?=get_permalink($b)?>?preview" class="box-iframe" sandbox="allow-modals allow-pointer-lock allow-presentation allow-same-origin allow-scripts"></iframe>
								</div>
							</div>
							<h3 class="">
								<a href="<?=get_permalink($b)?>" class="font-bold text-slate-600 hover:text-slate-400"><?=$b->post_title?></a>
							</h3>
							<h4 class="text-yellow-600 text-sm"><?=get_the_date( $d = 'j F Y - g:i A', $b )?></h4>
							
						</div>
						<?php
					}
					echo '</div>';
				}else{
					echo 'Nothing.';
				}
				wp_reset_query();
				?>
			</div>
		</div>
	</section>


</main><!-- #main -->

<?php
// pre($author);
get_footer();
