<?php
include_once( 'views/partials/header.php' );
include_once( 'system/db-connect.php' );


$albumsCount = 9;
$rows = ceil( $albumsCount / 3 );

?>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <section>
               <?php
				   $files = glob("img/*.*");
				   var_dump($files);
				   for ($i=1; $i<count($files); $i++){
					  $image = $files[$i];

					  print $image ."<br />";
					  echo '<img src="'.$image .'" alt="Random image" />'."<br /><br />";
				   }

				 ?>
            </section>
        </div>
    </div>
</main>
<?php include_once( 'views/partials/footer.php' );

   