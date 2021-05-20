jQuery(".page-arrow").click(function(){
    if (jQuery(this).hasClass("next")) {
        var type = 1
    } else if (jQuery(this).hasClass("prev")) {
        var type = 0
    }
    slideSwitch(type)
})

jQuery(window).on("load", function() {
    setInterval(() => {
        slideSwitch(1)
    }, 10000);
})

function slideSwitch(type) {
    var numSlides = jQuery(".heroine-slide").length
    let currslide = parseInt(jQuery(".heroine-slide.active").attr("slide-id"))
    if (type == 1) {
        var nextslide = currslide + 1
    } else if (type == 0) {
        var nextslide = currslide - 1
    }
    
    if (nextslide == 0) {
        var nextslide = numSlides
    } else if (nextslide > numSlides) {
        var nextslide = 1
    }
    jQuery(".heroine-slide.active").addClass("fade-out");
    setTimeout(() => {
        jQuery(".heroine-slide.active").removeClass("active");
        jQuery(".heroine-page.active").removeClass("active");
        jQuery(".heroine-slide[slide-id='" + nextslide +"']").addClass("fade");
    }, 500);
    setTimeout(() => {
        jQuery(".heroine-page[page-id='" + nextslide +"']").addClass("active");
        jQuery(".heroine-slide[slide-id='" + nextslide +"']").addClass("fade-in");
    }, 600);
    setTimeout(() => {
        jQuery(".heroine-slide[slide-id='" + nextslide +"']").addClass("active");
        jQuery(".heroine-slide.active").removeClass("fade-in");
        jQuery(".heroine-slide.active").removeClass("fade");
        jQuery(".heroine-slide.fade-out").removeClass("fade-out");
    }, 1000);
}