<?php include('inc/connexion.php');?>

<?php

try
{

$sql =

"SELECT footerFacebook, footerInstagram, footerTwitter FROM main";
$request = $db->prepare($sql);
$request->execute();
$mainDonnees = $request->fetch(); 


$sql2 =

"SELECT pageHeaderImage, pageTitle, pageDescription, pageImage1, pageImage2 FROM portfoliopage WHERE id = :id";
$params = array (
    ':id'=> $_GET['id']
);
$request2 = $db->prepare($sql2);
$request2->execute($params);
$portfolioData = $request2->fetch(); 

}
catch(PDOException $ex)
{
die("Erreur " . $ex->getMessage());
}
?>


<?php include("inc/header.php"); ?>

        <div class="hero" style="background: url('<?php echo('./assets/img/'.$portfolioData['pageHeaderImage'])?>') no-repeat center center/cover; background-attachment: fixed;">
        <div class="content">
            <h1 class="portfolio__page__tittle"><?php echo $portfolioData['pageTitle']?></h1>
          </div>
        </div>
                    
        <!--===== BIO =====-->

        <section class="portfolio__page">
            <div class="portfolio__page__container">
                      <p class="text-justify"><?php echo $portfolioData['pageDescription']?></p>
              </div>
          </div>
      </section>

      <section class="showcase">
        <div class="showcase-container">
            <ul class="showcase-container-list">
                <li><img src="<?php echo('./assets/img/'.$portfolioData['pageImage1'])?>" alt="showcase1"></li>
                <li><img src="<?php echo('./assets/img/'.$portfolioData['pageImage2'])?>" alt="showcase2"></li>
            </ul>
        </div>
    </section>

    <?php include("inc/footer.php"); ?>