<?php snippet('header') ?>

  <main>

    <a href="<?php echo page('risorse')->url() ?>" class="link link-back"><span>Torna indietro</span></a>

    <h1 class="title-article"><?php echo ucfirst( page()->title()->html() ) ?></h1>

    <div class="resource-experience">
    <?php if( page()->movie()->isNotEmpty() ): ?>

      <h2 class="visuallyhidden">Video dell'evento</h2>

        <?php if( page()->alt_video()->isNotEmpty()) {

            $alt_video = page()->alt_video();

          } else {
              $alt_video = "Video dell'evento " . page()->title()->html();
          }

        ?>
        <div class="video" aria-label="<?php echo $alt_video ?>">
        
          <iframe src="https://player.vimeo.com/video/<?php echo page()->movie() ?>" allowFullScreen></iframe>

         
        
          <!--
          <object width="500" height="281"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="movie" value="https://vimeo.com/moogaloop.swf?clip_id=<?php echo page()->movie() ?>&amp;show_byline=0&amp;show_portrait=0&amp;force_embed=vimeo.com&amp;fullscreen=1"><embed src="https://vimeo.com/moogaloop.swf?clip_id=<?php echo page()->movie() ?>&amp;show_byline=0&amp;show_portrait=0&amp;force_embed=vimeo.com&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="allowfullscreen" allowscriptaccess="always" width="500" height="281"></object>

           -->
    
        </div>


      <?php else: ?>

        <img src="<?php echo page()->image($resource->main_image())->url() ?>" alt="<?php echo page()->image($resource->main_image())->alt()->kt()->html() ?>">
      <?php endif ?>
    </div>

    <div class="resource-experience-text">
      <div class="border-top">
        <div class="aside">
          <h3 id="partners">In collaborazione con</h3>
          <p><?php echo page()->partner()->html() ?></p>
          <h3 id="location">Data e luogo</h3>
          <p><?php echo page()->date('d.m.Y') ?>, <?php echo page()->location()->html() ?></p>
        </div>
        <div id="article">
          <h3 class="subtitle">Descrizione dell'evento</h3>
        <?php echo page()->long()->kt()->html() ?>
        </div>
      </div>
    </div>

    <?php if(page()->gallery()->isNotEmpty()): ?>

    <?php echo js('assets/js/lightbox.js'); ?>

    <section class="resource-experience-gallery">
      <h2>Fotografie dell'evento</h2>

      
      <ul>
        <?php foreach(page()->gallery()->yaml() as $image): ?>
        <li>
          <figure>

          <?php 
            // retrieve the alt text from the image, if not present, use a generic one
            $img = $page->image($image);
            if($img->alt()->isNotEmpty()) {
              $alt_img = $img->alt()->html();
            }
            else {
              $alt_img = "Fotografia dell'evento " . page()->title()->html();
            }
          ?>

            <a href="<?php  echo $img? $img->url() : '' ?>" data-lightbox="prova1" data-title="<?php echo $alt_img ?>">
            <img src="<?php echo $img? $img->url() : '' ?>" alt="<?php echo $alt_img ?>" class="<?php e($img->dimensions()->portrait(), 'portrait', 'landscape'); ?>" />
        </a>
          </figure>
        </li>
        <?php endforeach ?>
        </ul>
      
      <!--
      <?php foreach(page()->gallery()->yaml() as $image): ?>

        <a href="<?php $img = $page->image($image); echo $img? $img->url() : '' ?>" data-lightbox="prova1" data-title="<?php echo page()->title()->html() ?>">
          <img src="<?php $img = $page->image($image); echo $img? $img->url() : '' ?>" alt="<?php echo page()->title()->html() ?>" class="<?php e($img->dimensions()->portrait(), 'portrait', 'landscape'); ?>" />
        </a>

      <?php endforeach ?>

      -->

      <!--
      <ul>
        <?php foreach(page()->gallery()->yaml() as $image): ?>
        <li>
          <figure>
            <img src="<?php $img = $page->image($image); echo $img? $img->url() : '' ?>" alt="<?php echo page()->title()->html() ?>" class="<?php e($img->dimensions()->portrait(), 'portrait', 'landscape'); ?>" />
          </figure>
        </li>
        <?php endforeach ?>
        </ul>
        -->

    </section>

  <?php endif ?>

  </main>

<?php snippet('footer') ?>

