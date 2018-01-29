<?php snippet('header') ?>

<div id="kit">
	<main id="kit-single" class="<?php echo page()->parent()->title('it') ?>">
		<div id="title-bar">
			
			<a href="/<?php echo $site->language() ?>/kit/#<?php $url = $page->parent()->url(); $pos = strripos($url, '/'); echo substr($url, $pos+1); ?>" class="back-button">&lt; <?php echo l::get('back')?></a>

			<header>
				<div id="kit-title">
					<h1 ><?php echo page()->title()->html() ?></h1>
					<h2><?php echo page()->parent()->title()->html() ?></h2>
				</div>


				<div id="kit-icon">
					<?php if (page()->icon()->isNotEmpty() ): ?>
						<img src="<?php echo page()->image(page()->icon())->url() ?>">
					<?php else: ?>
						<img src="<?php echo ($kirby->urls()->assets()) ?>/icons/empty-kit-icon.png">
					<?php endif ?>
				</div>

				<div id="main-description">
					<div><?php echo $page->description()->kt()?></div>
				</div>

			</header>
		</div>

		<!-- MAIN ARTICLE -->

		<article>

			<!-- INDEX -->
			<aside>
				&nbsp;
				<div id="index_menu">
					<h2>
						<?php echo l::get('index') ?>
					</h2>
					<ul>
					<?php $prev = ""; $ul_count = 0; foreach (page()->article()->toStructure() as $item): ?>
					<?php if($prev == "one" && $prev != $item->option_type() || $prev == "two" && $prev != $item->option_type()): ?><?php $ul_count++ ?><ul class="ul_<?php echo $item->option_type() ?>">
					<?php elseif($prev == "three" && $prev != $item->option_type()): ?><?php $ul_count--?></li></ul></li>
						<?php if($item->option_type() == "one" && $ul_count == 1): ?></ul>
						<?php elseif($item->option_type() == "one" && $ul_count == 2): ?></ul></li></ul>
						<?php endif ?>
					<?php elseif($prev == $item->option_type()):?></li>
					<?php endif ?>	<li class="<?php echo $item->option_type() ?>"><a href="#<?php echo str_replace(' ', '-', strtolower($item->section_title())) ?>"><?php echo $item->section_title() ?></a><?php $prev = $item->option_type(); ?>
					<?php endforeach ?>
					<?php if($ul_count == 2): ?></ul></li></ul></li>
					<?php elseif($ul_count == 1): ?>
						<?php if($prev == "three") echo "</ul></li>"; ?>
					<?php endif ?>
						
						<li class="one"><a href="#evaluate"><?php echo l::get('evaluate') ?></a></li>
					</ul>
					<div class="back_button_index"><a href="/<?php echo $site->language() ?>/kit/#<?php $url = $page->parent()->url(); $pos = strripos($url, '/'); echo substr($url, $pos+1); ?>">&lt; <?php echo l::get('back')?></a></div>
				</div>
			</aside>
			<!-- end: INDEX -->

			<header class="visuallyhidden">
				<h1><?php echo page()->title() ?></h1>	
			</header>

			<!-- CONTENT -->

			<!-- NEW STRUCTURE -->

			<div id="single-article-container">
			<?php $array_length = count(page()->article()->yaml()); $i = 1; ?>	<!-- necessary to close the ul at the last item on the foreach loop if end of a list -->
			<?php $prev = ""; foreach (page()->article()->toStructure() as $item): ?>

				<?php if($item->option_type() == "one"): ?>

					<?php if($prev == "three") echo "</ul>"; ?>

					<?php if($prev != "") echo "</div>"; ?> <!-- closing the "section-container" div -->

					<div class="section-h-line"></div>
					<div class="section-container">
					<h2 id="<?php echo str_replace(' ', '-', strtolower($item->section_title())) ?>"><?php echo $item->section_title() ?></h2>
					<?php echo $item->content()->kt() ?>

				<?php elseif($item->option_type() == "two"): ?>

					<?php if($prev == "three") echo "</ul>"; ?>
				
					<h3 id="<?php echo str_replace(' ', '-', strtolower($item->section_title())) ?>"><?php echo $item->section_title() ?></h3>
					<?php echo $item->content()->kt() ?>

				<?php elseif($item->option_type() == "three"): ?>

					<?php if($prev != "three"): ?>
						<?php echo "<ul class='content-list'>" ?>
					<?php endif ?>

						<li>
							<div class="bullet"></div>
							<h4 id="<?php echo str_replace(' ', '-', strtolower($item->section_title())) ?>"><?php echo $item->section_title() ?></h4>
							<?php echo $item->content()->kt() ?>
						</li>

						<?php if($prev == "three" && $i == $array_length) echo "</ul>"; ?> 	<!-- close the ul if necessary -->
							
				<?php endif ?>

				<?php $prev = $item->option_type(); $i += 1; ?>

			<?php endforeach ?>

			</div>

			<!-- evaluation block -->
			<div class="section-h-line"></div>
			<div class="section-container evaluate">
				<h2  id="evaluate"><?php echo l::get('evaluate') ?></h2>
				<?php echo page()->parent()->verify()->kt() ?>
				<div id="article_end"></div>
			</div>

			<!-- end: CONTENT -->

			<!-- PDF of the article -->
			<?php if(page()->pdf_article()->isNotEmpty()): ?>
				<div id="container-button-article-pdf">
					<a href="<?php echo page()->document(page()->pdf_article())->url() ?>" target="_blank"><div class="button"><?php echo l::get('pdf-article') ?></div></a>
				</div>
			<?php endif ?>
			</div>

		</article>

		<!-- end: MAIN ARTICLE -->


		<!-- RESOURCES CONNECTED TO THE PATH -->

		<?php if(page()->links_to_resources()->isNotEmpty()): ?>
			<div class="path-single">
				<section id="related-resources">
					<h2><?php echo l::get('related-resources') ?></h2>
						<?php
							//--- SORT THE LINKED KITS of the path ---//

							echo "<ul id='single-resources'>";
							foreach (page()->links_to_resources()->toStructure() as $uid) {

								foreach (page('risorse')->children()->visible() as $item) {

									if($item->uid() == $uid) {
										echo "<li><a href='".$item->url()."'>";
										echo "<h3>".$item->title()."</h3>";
										echo "<p class='resource-description'>".shortstring($item->short()->html(), 300)."</p>";
										echo "<div class='resource-image'><img src='".$item->image($item->main_image())->url()."'></div>";
										echo "</a></li>";
									}
								}
							}
							echo "</ul>";
						?>
				</section>
		</div>
		<?php endif ?>
		<!-- end -->


		<!-- MORE READING NEXT KITS -->
		<?php 		
			$offset = 1 + $page->siblings(false)->visible()->indexOf($page);
			$coll = $page->siblings(false)->visible()->offset($offset)->limit(3);
			if ($coll->count() < 3) {
				$coll2 = $page->siblings(false)->visible()->limit(3 - $coll->count());
				$coll = $coll->merge($coll2);
			}
		?>
		<?php if ($coll->count()): ?>
				
			<div id="more-articles">
					<h2><?php echo l::get('more') ?></h2>
					
					<ul class="single-kit">
						<?php foreach( $coll as $kit): ?>
						<li>
							<a href="<?php echo $kit->url() ?>">	
								<?php if($kit->icon()->isNotEmpty()): ?>
								<div class="kit-icon">
									<img src="<?php echo $kit->image($kit->icon())->url() ?>">
									<?php else: ?>
										<img src="<?php echo ($kirby->urls()->assets()) ?>/icons/empty-kit-icon.png">
									<?php endif ?>
								</div>
								
								<h3><?php echo ucfirst($kit->title()) ?></h3>
								<p class="kit-description"><?php echo shortstring($kit->description()->html(), 200) ?></p>
							</a>
						</li>

						<?php endforeach ?>

						<?php if (count($coll) < 3): ?>
						
						<?php endif ?>
					</ul>
			</div>

		<?php endif ?>
		<!-- end: MORE -->

		<a href="/<?php echo $site->language() ?>/kit/#<?php $url = $page->parent()->url(); $pos = strripos($url, '/'); echo substr($url, $pos+1); ?>" class="back-button">&lt; <?php echo l::get('back')?></a>

		<!-- load the lightbox script -->
		<?php echo js('assets/js/lightbox.js'); ?>

	</main>
</div>

<?php snippet('footer') ?>