<!-- ENTI PROMOTORI-->

<section class="enti">
	<h2 class="title-enti">Enti promotori e partner</h2>
	<ul>
	<?php foreach( page('progetto/partner')->partners()->toStructure() as $partner): ?>
		<li>
		<?php $image = $partner->logo_footer() ?>
			<a href="<?php echo page('progetto/partner')->url() ?>/#<?php echo str_replace(' ', '_', strtolower($partner->name())) ?>">
				<img src="<?php echo page('progetto/partner')->image($image)->url() ?>" alt="Logo <?php echo $partner->name()->html() ?>">
			</a>
		</li>
	<?php endforeach ?>
	</ul>
</section>

<!-- end: ENTI PROMOTORI -->