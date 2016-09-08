jQuery(document).ready(function($) {

    // Prettyphoto - for desktops only
    if ($(window).width() > 767) {

        // PrettyPhoto Without gallery
        $("a[rel^='lightbox']").prettyPhoto({
            show_title: false,
            social_tools: false,
            slideshow: false,
            autoplay_slideshow: false,
            wmode: 'opaque'
        });

        // PrettyPhoto With Gallery
        $("a[rel^='LightboxGallery']").prettyPhoto({
            show_title: false,
            social_tools: false,
            autoplay_slideshow: false,
            overlay_gallery: true,
            wmode: 'opaque'

        });

    }
});

jQuery(function(e) {

    var n = e(".navigation-main").clone().removeClass("navigation-main").addClass("navigation-main-mobile").attr("id", "site-navigation-mobile").append('<h1 class="menu-toggle"></h1>');

e(".site-header").append(n), e(".menu-toggle").on("click", function() {
        e(this).toggleClass("toggled-on"), e(".navigation-main-mobile .menu").slideToggle(), e("#main").toggleClass("display-off")
    }),

e(".toggle-top").on("click", function(n) {
        e(this).toggleClass("top-display"), e(".top-wrapper").slideToggle(), n.preventDefault()
    }),

e(".flexslider").flexslider({
        animation: "slide",
        controlNav: !1,
        pauseOnHover: !0
    }),

e("#main").fitVids();

});

   // For Scroll to top button
   jQuery("#scroll-up").hide();
   jQuery(function () {
      jQuery(window).scroll(function () {
         if (jQuery(this).scrollTop() > 1000) {
            jQuery('#scroll-up').fadeIn();
         } else {
            jQuery('#scroll-up').fadeOut();
         }
      });
      jQuery('a#scroll-up').click(function () {
         jQuery('body,html').animate({
            scrollTop: 0
         }, 800);
         return false;
      });
   });