<div class="row">
    <div class="col-md-12">
        <div id="rating_wrapper">
            <!-- inline width below is rating out of 100 -->
            <span class="full_stars" style="width: <?php echo $entry["review_rating"]*100/5?>%;">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
            </span>
            <span class="empty_stars" >
                <span class="glyphicon glyphicon-star-empty"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
            </span>
        </div>
        <b><?php echo $entry["user_name"]?></b> 
        <span class="pull-right"><?php echo $entry["review_created_at"]?></span>
        <div class="clearfix"></div>
        <p><?php echo $entry["review_comment"]?></p>
     </div>
</div>
<hr>