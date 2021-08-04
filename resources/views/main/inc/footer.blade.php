<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <h6>About</h6>
          <p class="text-justify">{!! $s !!}</p>
        </div>

        <div class="col-6 col-md-3">
          <h6>Categories</h6>
          <ul class="footer-links ">
            <li><a href="#">Website Design</a></li>
            <li><a href="#">UI Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Video Editor</a></li>
            <li><a href="#">Theme Creator</a></li>
            <li><a href="#">Templates</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-3">
          <h6>Quick Links</h6>
          <ul class="footer-links">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Contribute</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Sitemap</a></li>
          </ul>
        </div>
      </div>
      <hr class="small">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6 col-12">
          <p class="copyright-text">Copyright © 2020 All Rights Reserved by
            <a href="#">Code4Education</a>.
          </p>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
          <ul class="social-icons">
            <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a class="dribbble" href="#"><i class="fab fa-dribbble"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('main-assets/js/script.js') }}"></script>

<!-- TESTIMONIAL START -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

<!-- TESTIMONIAL END -->
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

/*TESTIMONIAL*/

$(document).ready(function(){
    $("#testimonial-slider").owlCarousel({
        items:1,
        itemsDesktop:[1000,1],
        itemsDesktopSmall:[979,1],
        itemsTablet:[768,1],
        pagination: true,
        slideSpeed:1000,
        singleItem:true,
        transitionStyle:"fadeUp",
        autoPlay:true
    });
}); 

</script>





</body>
</html>