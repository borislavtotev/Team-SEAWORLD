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
<<<<<<< HEAD
				   for ($i=0; $i<count($files); $i++){
					   $image = $files[$i];
                       ?>
                       <div><?= $image ?></div>
                       ?>
                       <div>
                           <img src="'.$image .'" alt="Random image" />
                       </div>
                       <?php
				   }

				 ?>
=======
				   for ($i=1; $i<count($files); $i++):
					  $image = $files[$i];?>

					  <?php echo '<img src="'.$image .'" alt="Random image" id="news-pic"/>'."<br /><br />"; ?>
					  
				   <?php endfor; ?>
>>>>>>> origin/master
            </section>
        </div>
    </div>
</main>
<?php include_once( 'views/partials/footer.php' );

   