<?php
include_once( 'views/partials/header.php' );
include_once( 'system/db-connect.php' );


$albumsCount = 9;
$rows = ceil( $albumsCount / 3 );

?>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <section class="jumbotron animated fadeInDownBig">
            	<?php
				   $files = glob("img/*.*");
				   for ($i=1; $i<count($files); $i++):
               			$image = $files[$i];?>
						<div class="news-img-section">
							<img src="<?=$image?>" alt="Random image" id="news-pic"/>
							<aside>
								<h2>Image name</h2>
								<h4>Comments</h4>
								<ul class="comments">
									<li class="comment">HI</li>
									<li class="comment">Wow</li>
									<li class="comment">xaxa</li>
								</ul>
							</aside>
						</div>
				   <?php endfor; ?>
            </section>
        </div>
    </div>
</main>
<?php include_once( 'views/partials/footer.php' );
