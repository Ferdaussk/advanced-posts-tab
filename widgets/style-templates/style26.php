<?php
/**
 * @===================//// Template design
 */

echo '<div class="apostst-gallery-filtering-twenty-seven apostst-gallery-filtering-common">';
  echo '<div class="container-fluid p-0">';
    echo '<div class="row">';
      echo '<div class="col-xl-12">';
        echo '<div class="apostst-gallery-menu-twenty-seven d-flex apostst-my-commonsk-class pb-40">';
        include( __DIR__ . '/texo-datas/items.php' );
        echo '</div>';
      echo '</div>';
    echo '</div>';
    echo '<div class="row apostst-grid-twenty-seven apostst-grid-common section g-0" id="boxContainer">';
      include( __DIR__ . '/texo-datas/datas-all.php' );
    echo '</div>';
  echo '</div>';
echo '</div>';