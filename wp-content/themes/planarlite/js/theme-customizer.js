(function($) {
    wp.customize('background_color', function(value) {
        value.bind(function(to) {
            $('.site-content').css('background', to)
        })
    });
    wp.customize('planar_header_bgcolor', function(value) {
        value.bind(function(to) {
            $('body').css('background', to)
        })
    });
    wp.customize('planar_footer_bgcolor', function(value) {
        value.bind(function(to) {
            $('.site-footer').css('background', to)
        })
    });
    wp.customize('planar_additional_color', function(value) {
        value.bind(function(to) {
            $('figure.tile, input[type="submit"], input[type="reset"], input[type="button"], button, .btn').css('background', to)
        })
    });
    wp.customize('planar_additional_color', function(value) {
        value.bind(function(to) {
            $('a').css('color', to)
        })
    });
    wp.customize('planar_menu_color', function(value) {
        value.bind(function(to) {
            $('#header-title, #header-title a, .navigation-main li a, .menu-toggle::before, .toggle-top::before, #menu-topic a:hover, .tagline-txt h1, .headline .entry-title, .headline p').css('color', to)
        })
    });
    wp.customize('planar_secondary_color', function(value) {
        value.bind(function(to) {
            $('.top-wrapper').css('background', to)
        })
    });
    wp.customize('planar_secondary_color', function(value) {
        value.bind(function(to) {
            $('.site-footer, .navigation-main ul li:hover > a,.navigation-main ul li.current_page_item > a').css('color', to)
        })
    });
    wp.customize('planar_footer_color', function(value) {
        value.bind(function(to) {
            $('.site-footer, .footer-widget a').css('color', to)
        })
    });
    wp.customize('planar_home_headline', function(value) {
        value.bind(function(to) {
            $('#home-tagline').html(to)
        })
    });
    wp.customize('planar_blog_headline', function(value) {
        value.bind(function(to) {
            $('#blog-tagline').html(to)
        })
    });
    wp.customize('planar_footer_copyright_text', function(value) {
        value.bind(function(to) {
            $('#copyright-message').text(to)
        })
    })
})(jQuery);