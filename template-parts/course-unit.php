<?php 
$f = $args['f'];
$is_mod = $args['is_mod'];
 ?>

<div id="units" class="bg-slate-50 py-16">
	<div class="container mx-auto">
		<h2 class="text-3xl font-bold mb-8 text-slate-600">
			<i class="fas fa-bug mr-2"></i>
			Course Box Units
		</h2>
		<?php 
		foreach ($f['units'] as $ui => $u) {
			if ($u['status'] == 'show' OR $is_mod) {
				?>
				<div class="unit-status-<?=$u['status']?> bg-white p-6 rounded border-slate-200	border-2 mb-6" id="unit_<?=$ui?>">
					<?php 
					if ($is_mod) {
						if ($u['status'] == 'hidden') {
							$is_hide = 'selected';
						}
						?>
						<form method="post" action="#unit_<?=$ui?>">
							<input type="hidden" name="ui" value="<?=$ui?>">
							<h3 class="text-2xl text-slate-500 mb-2">
								<input type="text" name="title" value="<?=$u['title']?>" class="font-bold w-full">
							</h3>
							<select name="status">
								<option value="show">Show</option>
								<option value="hidden" <?=$is_hide?>>Hidden</option>
							</select>
							<button class="bg-slate-100 text-slate-500 px-2 py-1 text-sm rounded" name="form" value="edit_unit">Save</button>
						</form>
						<?php
					}else{
						?>
						<h3 class="text-2xl text-slate-500 font-bold"><?=$u['title']?></h3>
						<?php 
					}

					foreach ($u['box'] as $bi => $b) {
						$box_type = get_post_type($b->ID);
						$cl = 'blue';
						$branch_label = 'Branch';
						if ($box_type == 'exercise'){
							$cl = 'violet';
							$branch_label = 'Assignment';
						}
						$cl_bdt = $cl;
						$branch = get_user_branch($b->ID,$uid);
						?>
						<div class="unit-box unit-box-<?=$box_type?>   mt-4 bg-slate-100 border-t-4 border-<?=$cl_bdt?>-300">
							<div class="unit-box-icon  p-4 border-r-2 border-slate-200 text-<?=$cl?>-600">
								<i class="fas fa-code <?=$box_type?>"></i>
							</div>
							<div class="unit-box-details  p-4">
								<h4 class="text-lg font-bold text-slate-700"><?=$b->post_title?></h4>
								<?php if ($box_type == 'exercise'): 
									$fb = get_fields($b->ID);
									?>
									<div class="text-slate-500">
										หมดเขตส่ง  <b class="text-slate-600"><?=$fb['due_date']?></b><br>
										คะแนนเต็ม <b class="text-slate-600"><?=$fb['score']?> คะแนน</b>
									</div>
								<?php endif ?>
								<div class="mt-4 mb-4 font-bold">
									<a href="<?=get_the_permalink($b->ID)?>" target="_blank">
										<span class="rounded-md border-slate-200 px-3 py-2 text-sm mr-2 bg-<?=$cl?>-600 hover:bg-<?=$cl?>-700 border-2 border-<?=$cl?>-600 hover:border-<?=$cl?>-700  text-white">View Code</span>
									</a>
									<?php if (sizeof($branch)>0): ?>
										<a href="<?=get_the_permalink($branch[0]->ID)?>" target="_blank">
											<span  class="rounded-md border-2 border-<?=$cl?>-400 px-3 py-2 text-sm mr-2 hover:border-<?=$cl?>-700 text-<?=$cl?>-400 hover:text-<?=$cl?>-700">View Your <?=$branch_label?></span>
										</a>
									<?php endif ?>
								</div>
							</div>
						</div>
						<?php
					}
					?>
					<?php if ($is_mod): ?>
						<div class="mt-6 ">
							<form method="post" action="#unit_<?=$ui?>">
								<input type="hidden" name="ui" value="<?=$ui?>">
								<button class="rounded-md border-2 border-blue-600 px-3 py-2 text-sm mr-2 hover:border-blue-700 text-blue-600 hover:text-blue-700 text-white font-bold" name="new_box" value="lesson">
									<i class="fas fa-code  mr-2"></i>
									Add New Lesson
								</button>
								<button class="rounded-md border-2 border-violet-600 px-3 py-2 text-sm mr-2 hover:border-violet-700 text-violet-600 hover:text-violet-700 text-white font-bold" name="new_box" value="exercise">
									<i class="fas fa-code exercise mr-2"></i>
									Add New Exercise
								</button>
							</form>
						</div>
					<?php endif ?>
				</div>
				<?php
			}
		}
		?>
	</div>

	<?php if ($is_mod): ?>
		<div class="mt-4">
			<div class="container mx-auto text-center">
				<form method="post" action="#unit_<?=$ui+1?>">
					<input type="text" name="title" placeholder="Unit Title" class="font-bold rounded-md px-3 py-2 text-sm mr-2  border-2 border-slate-200">
					<button class="rounded-md border-slate-200 px-3 py-2 text-sm mr-2 bg-slate-500 hover:bg-slate-600 border-2 border-slate-500 hover:border-slate-600 font-bold  text-white" name="form" value="new_unit">
						Add New Unit
					</button>
				</form>

			</div>
		</div>
	<?php endif ?>
</div>