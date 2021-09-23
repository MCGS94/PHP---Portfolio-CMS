<?php include('inc/connexion.php');?>


<?php
try
{
$sql =

"SELECT headerImage, aboutName, aboutJob, aboutDescription, aboutLinkedin, aboutGithub, aboutDribble, skillsTitle1, skillsContent1, skillsTitle2, skillsContent2, contactEmail, contactPhone, contactAdress, footerFacebook, footerInstagram, footerTwitter FROM main";

$request = $db->prepare($sql);
$request->execute();
$mainData = $request->fetch(); 

$sql2 =

"SELECT id, pageHeaderImage, pageTitle FROM portfoliopage";

$request2 = $db->prepare($sql2);
$request2->execute();
$listPortfolios = $request2->fetchAll(); 
}


catch(PDOException $ex)
{
die("Erreur " . $ex->getMessage());
}
?>



<?php include("inc/header.php"); ?>

        <main class="l-main">
            <!--===== HOME =====-->
            <section class="home" id="home">
                <div class="home__container bd-grid">
                    <h1 class="home__title"><span>HE</span><br>LLO.</h1>

                    <div class="home__scroll">
                        <a href="#about" class="home__scroll-link"><i class='bx bx-up-arrow-alt' ></i>Scroll down</a>
                    </div>

                    <img src="<?php echo('./assets/img/'.$mainData['headerImage']);?>" alt="" class="home__img">
                </div>
            </section>
            
            <!--===== ABOUT =====-->
            <section class="about section" id="about">
                <h2 class="section-title">About</h2>

                <div class="about__container bd-grid">
                    <div class="about__img">
                        <img src="<?php echo('./assets/img/'.$mainData['headerImage']);?>" alt="profile_pic">
                    </div>

                    <div>
                        <h2 class="about__subtitle"><?php echo $mainData['aboutName']?></h2>
                        <span class="about__profession"><?php echo $mainData['aboutJob']?></span>
                        <p class="about__text"><?php echo $mainData['aboutDescription']?></p>

                        <div class="about__social">
                            <a href="<?php echo $mainData['aboutLinkedin']?>" class="about__social-icon"><i class='bx bxl-linkedin' ></i></a>
                            <a href="<?php echo $mainData['aboutGithub']?>" class="about__social-icon"><i class='bx bxl-github' ></i></a>
                            <a href="<?php echo $mainData['aboutDribble']?>" class="about__social-icon"><i class='bx bxl-dribbble' ></i></a>
                        </div>
                    </div>
                </div>
            </section>

            <!--===== SKILLS =====-->
            <section class="skills section" id="skills">
                <h2 class="section-title">Skills</h2>

                <div class="skills__container bd-grid">
                    <div class="skills__box">
                        <h3 class="skills__subtitle"><?php echo $mainData['skillsTitle1']?></h3>
                        <div id="skills__name"></div>
                        
                        
                        <h3 class="skills__subtitle"><?php echo $mainData['skillsTitle2']?></h3>
                        <div id="skills__name2"></div>

                    </div>

                    <div class="skills__img">
                        <img src="assets/img/skill.jpg" alt="">
                    </div>
                </div>
            </section>

            <!--===== PORTFOLIO =====-->
            <section class="portfolio section" id="portfolio">
                <h2 class="section-title">Portfolio</h2>

                <div class="portfolio__container bd-grid">

                <?php foreach ($listPortfolios as $portfolioData): ?>

                    <div class="portfolio__img">
                        <img src="<?php echo('./assets/img/'.$portfolioData['pageHeaderImage'])?>" alt="<?php echo $portfolioData['pageTitle']?>">
                        <div class="portfolio__link">
                            <a href="portfolio-page.php?id=<?php echo $portfolioData['id']?>" class="portfolio__link-name"><?php echo $portfolioData['pageTitle']?></a>
                        </div>
                    </div>
                    
                <?php endforeach;?>
                    
                </div>
            </section>

            <!--===== CONTACT =====-->
            <section class="contact section" id="contact">
                <h2 class="section-title">Contact</h2>

                <div class="contact__container bd-grid">
                    <div class="contact__info">
                        <h3 class="contact__subtitle">EMAIL</h3>
                        <span class="contact__text"><?php echo $mainData['contactEmail']?></span>

                        <h3 class="contact__subtitle">PHONE</h3>
                        <span class="contact__text"><?php echo $mainData['contactPhone']?></span>

                        <h3 class="contact__subtitle">ADRESS</h3>
                        <span class="contact__text"><?php echo $mainData['contactAdress']?></span>
                    </div>

                    <form action="mail.php" class="contact__form" method="post">
                        <div class="contact__inputs">
                            <input type="text" placeholder="Name" class="contact__input" name="name">
                            <input type="mail" placeholder="Email" class="contact__input" name="email">
                        </div>

                        <textarea name="message" id="" cols="0" rows="10" class="contact__input"></textarea>

                        <button type="submit" class="contact__button" name="send">Send</button>
                        
                        <?php if(isset($_GET['error'])){

                            if(isset($_GET['message'])) {

                                echo '<p>'.htmlspecialchars($_GET['message']).'</p>';
                            }

                            } else if(isset($_GET['success'])) {

                            echo '<p>Message Sent.</p>';
                        } ?>
                    </form>
                    
                </div>
            </section>
        </main>

        

<?php include("inc/footer.php"); ?>
