/* PAGE TRANSITION */
jQuery(window).bind("pageshow", function(event) {
    if (event.originalEvent.persisted) {
        window.location.reload() 
    }
});

jQuery( window ).on( "load", function() {
    setTimeout(() => {
        jQuery("body").addClass("visible");
    }, 150);
});

jQuery("a").click(function(event){
    event.preventDefault();

    var location = jQuery(this).attr("href");

    if (location.startsWith("mailto:")) {
        window.location.href = location;
    } else if (location.startsWith("http")) {
        var target = jQuery(this).attr("target");
        var domain = location.split("/")[2];
        var currDomain = window.location.href.split("/")[2];

        if (target == "_blank") {
            window.open(location, '_blank');
        } else if (domain != currDomain) {
            window.location.href = location;
        } else if (jQuery(this).hasClass("page-numbers")) {
            jQuery("#ajax").load(location + " .post_grid");
            jQuery(".page-numbers.current").removeClass("current");
            jQuery(this).addClass("current");
            history.replaceState({}, "",location);
        } else {
            jQuery("#page-transition").addClass("show");
            setTimeout(() => {
                window.location.href = location;
            }, 700);
        }
    } else if (location.startsWith("#")) {
        window.location.href = location;
    } else {
        jQuery("#page-transition").addClass("show");
        setTimeout(() => {
            window.location.href = location;
        }, 700);
    }
})

/* MOBILE MENU */
jQuery("#mobile-navmenu").click(function(){
    jQuery("#mobile-menu-cont").addClass("show");
})

jQuery("#close-box").click(function(){
    jQuery("#mobile-menu-cont").removeClass("show");
})

/* LANGUAGE PICKERS */
jQuery(".lang-pick").click(function(){
    if (jQuery(this).hasClass("current")) {
        return
    } else {
        window.location.href = jQuery(this).attr("data-lang");
    }
})