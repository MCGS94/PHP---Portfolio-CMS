        <!--===== FOOTER =====-->
        <footer class="footer section">
            <div class="footer__container bd-grid">
                <div class="footer__data">
                    <h2 class="footer__title">Legal Mentions</h2>
                    <p class="footer__text">© to Portfolio</p>
                </div>
                
                <div class="footer__data">
                    <h2 class="footer__title">FOLLOW</h2>
                    <a href="<?php echo $mainDonnees['footerFacebook']?>" class="footer__social"><i class='bx bxl-facebook' ></i></a>
                    <a href="<?php echo $mainDonnees['footerInstagram']?>" class="footer__social"><i class='bx bxl-instagram' ></i></a>
                    <a href="<?php echo $mainDonnees['footerTwitter']?>" class="footer__social"><i class='bx bxl-twitter' ></i></a>
                </div>


            </div>
        </footer>

        <script type="text/javascript">

                        const skills = "<?php echo $mainData['skillsContent1']?>";
                        
                        const trimSkills = skills.replace(/\s*,\s*/g, ",");
                        
                        const arraySkills = trimSkills.split(',');
                        
                        arraySkills.forEach((skill) => {

                            const element = document.getElementById("skills__name")
                            const addSpan = document.createElement("span")
                            addSpan.classList.add("skills__name")
                            addSpan.append(skill)
                            element.appendChild(addSpan)                       
                        })
                        
                        const skills2 = "<?php echo $mainData['skillsContent2']?>";
                        
                        const trimSkills2 = skills2.replace(/\s*,\s*/g, ",");
                        
                        const arraySkills2 = trimSkills2.split(',');
                        
                        arraySkills2.forEach((skill2) => {

                            const element2 = document.getElementById("skills__name2")
                            const addSpan2 = document.createElement("span")
                            addSpan2.classList.add("skills__name")
                            addSpan2.append(skill2)
                            element2.appendChild(addSpan2)                       
                        }) 
         </script>

        <!--===== SCROLL REVEAL =====-->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>
        
    </body>
</html>