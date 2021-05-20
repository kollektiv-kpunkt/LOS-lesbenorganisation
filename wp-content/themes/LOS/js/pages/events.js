jQuery(".event-card").click(function(){
    if (jQuery(this).parent().hasClass("active")) {
        jQuery(".event-column-cont.active").removeClass("active");
    } else {
        jQuery(".event-column-cont.active").removeClass("active");
        jQuery(this).parent().addClass("active");
    }
})

/* LOAD MORE EVENTS */
jQuery("#loadmore").click(function(){
    jQuery(".event-column-cont.hidden").removeClass("hidden");
    jQuery("#loadmore-cont").remove();
    styleSets();
})