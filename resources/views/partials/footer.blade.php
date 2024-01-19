<!-- Javascript files-->
<script src="{{ asset('asset_landing/js/jquery.min.js') }}"></script>
<script src="{{ asset('asset_landing/js/popper.min.js') }}"></script>
<script src="{{ asset('asset_landing/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset_landing/js/jquery-3.0.0.min.js') }}"></script>
<script src="{{ asset('asset_landing/js/plugin.js') }}"></script>
<!-- sidebar -->
<script src="{{ asset('asset_landing/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('asset_landing/js/custom.js') }}"></script>
<!-- javascript -->
<script src="{{ asset('asset_landing/js/owl.carousel.js') }}"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script type="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2//2.0.0-beta.2.4/owl.carousel.min.js"></script>
<script>
    var $owl = $('.owl-carousel');

    $owl.children().each(function(index) {
        $(this).attr('data-position', index);
    });

    $owl.owlCarousel({
        center: true,
        loop: true,
        items: 3,
    });

    $(document).on('click', '.owl-item>div', function() {
        // see https://owlcarousel2.github.io/OwlCarousel2/docs/api-events.html#to-owl-carousel
        var $speed = 300; // in ms
        $owl.trigger('to.owl.carousel', [$(this).data('position'), $speed]);

    });
</script>
</body>

</html>
