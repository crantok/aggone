<?php if ($hide_page_title): // Use h1 for site name when not showing content title ?>

  <h1 id="site-name">

      <?php // Hard coding the site name because we want markup in it. ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span>1<sup>st</sup> Sector Success</span></a>

  </h1>

<?php else: // Use div for site name when a content title is shown ?>

  <div id="site-name">
    <strong>

      <?php // Hard coding the site name because we want markup in it. ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span>1<sup>st</sup> Sector Success</span></a>

    </strong>
  </div>

<?php endif; ?>
