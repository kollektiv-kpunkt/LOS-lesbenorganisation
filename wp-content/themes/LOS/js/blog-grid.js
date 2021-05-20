/* LOAD MORE POSTS */
jQuery("#loadmore").click(function(){
    jQuery(".blog-card.hidden").removeClass("hidden");
    jQuery("#loadmore-cont").remove();
    styleSets();
})