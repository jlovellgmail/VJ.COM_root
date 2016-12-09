<?php 
   
    if (isset($agallery) && $agallery->count() > 0) {?>

<div id="staticModal" class="lightBoxOverlay hide">
    <div class="lightBoxWrapper">
        <div class="lightBoxLeafWrapper">
            <div class="lightBoxClose"><i class="icon-cancel-1"></i></div>
            <div id="owlLarge" class="lightBoxCarousel owl-carousel">
            <?php    foreach ($agallery as $img) {
                $ImgUrl = $img->getImageUrl();
                ?>
                <div class="lightBoxImgWrapper">
                    <div class="lightBoxImg" style="background-image: url(<?php echo $ImgUrl; ?>); background-size: contain; background-color: #000;"></div>
                </div>
            <?php } ?>
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#owlLarge").owlCarousel({
            loop: true,
            margin: 15,
            autoplay: false,
            dots: false,
            nav: true,
            items: 1,
            startPosition: 0
        });
    });
</script>

    <?php } ?>