    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
       
        $('#headerImage').change(function(e){
        const fileName = e.target.files[0].name;
        $('#headerImageLabel').html(fileName);
        });

        $('#pageHeaderImage').change(function(e){
        const fileName = e.target.files[0].name;
        $('#pageHeaderImageLabel').html(fileName);
        });

        $('#pageImage1').change(function(e){
        const fileName = e.target.files[0].name;
        $('#pageImageLabel1').html(fileName);
        });

        $('#pageImage2').change(function(e){
        const fileName = e.target.files[0].name;
        $('#pageImageLabel2').html(fileName);
        });


        $('.deletebtn').on('click', function() {

            $('#deleteModal').modal('show');

                $tr = $(this).closest('tr');

                const data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);
                console.log( $('#delete_id').val(data[0]))

        });


    </script>

</body>



</html>