<div class="col-md-3">
<div class="slider" >
    <div>
        <img src="<?php echo base_url('uploads');?>/images/1.jpg" />
    </div>
    <div>
        <img src="<?php echo base_url('uploads');?>/images/2.jpg" />
    </div>
    <div>
        <img src="<?php echo base_url('uploads');?>/images/3.jpg" />
    </div>
    <div>
        <img src="<?php echo base_url('uploads');?>/images/4.jpg" />
    </div>
</div>

<style media="screen">
.slider {
  margin: 0px auto;
  position: relative;
  width: 100%;
  box-shadow: 0 0 20px rgba(0,0,0,0.4);
}

img {
  height: 150px;
  /*height: auto;*/
  max-width: 100%!important;
}

.slider > div {
  position: absolute;
}

</style>
<script>
    $(".slider > div:gt(0)").hide();
    $(".slider").height($(".slider > div > img").height());
    setInterval(function () {
        $('.slider > div:first')
          .fadeOut(1000)
          .next()
          .fadeIn(1000)
          .end()
          .appendTo('.slider');
    }, 3000);
    $(".slider").height($(".slider > div > img").height());
</script>
