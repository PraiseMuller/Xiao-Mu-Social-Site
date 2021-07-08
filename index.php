<?php
include('includes/header.php');

if (isset($_POST['post'])) {
    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');
}
?>

<div class="user-details column">
    <a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['profile_pic']; ?>"></a>

    <div class="user-details-left-right">
        <a href="<?php echo $userLoggedIn; ?>"> <?php echo  $user['firstname'] . " " . $user['lastname'] . "<br>"; ?> </a>
        <hr>
        <?php echo "Posts: " . $user['num_posts'] . "<br>";
        echo "Likes: " . $user['num_likes'];
        ?>
    </div>

</div>

<div class="main_column column">
    <form class="post_form" method="POST" action="index.php">
        <textarea name="post_text" id="post_text" placeholder="Say Something."></textarea>
        <input type="submit" name="post" id="post_button" value="Post">
        <hr>
    </form>

    <div class="posts_area"></div>

    <img id="loading" src="assets/images/icons/loading.gif" width="50px" height="50px">

</div>

<script>
    var userLoggedIn = '<?php echo $userLoggedIn ?>';

    $(document).ready(function() {
        $('#loading').show();

        //original ajax request for loading the first posts
        $.ajax({
            url: "includes/handlers/ajax_load_posts.php",
            type: "POST",
            data: "page=1&userLoggedIn=" + userLoggedIn,
            cache: false,

            success: function(data) {
                $('#loading').hide();
                $('.posts_area').html(data);
            }

        });

        $(window).scroll(function() {
            var height = $('.posts_area').height(); //div containing posts area
            var scroll_top = $(this).scrollTop();
            var page = $('.posts_area').find('.next_page').val();
            var noMorePosts = $('.posts_area').find('.noMorePosts').val();

            if (($(document).body.scrollHeight == $(document).body.scrollTop + $(window).innerHeight) && noMorePosts == 'false') {
                $('#loading').show();
                alert('mangoes')

                var ajax_req = $.ajax({
                    url: "includes/handlers/ajax_load_posts.php",
                    type: "POST",
                    data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                    cache: false,

                    success: function(response) {
                        $('.posts_area').find('.next_page').remove(); //remove current .next_page
                        $('.posts_area').find('.noMorePosts').remove();


                        $('#loading').hide();
                        $('.posts_area').append(response);
                    }

                });
            } //endif
            return false;
        }); //end $(window).scroll(function()

    });
</script>



</div>
</body>

</html>