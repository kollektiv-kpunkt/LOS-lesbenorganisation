jQuery(".amount-cont").click(function(){
    if (!jQuery(this).hasClass("active")) {
        jQuery(".amount-cont.active").removeClass("active");
        jQuery(this).addClass("active")
    }
})

jQuery("#donate-submit").one("click", function(e){
    e.preventDefault();
    let amount = jQuery(".amount-cont.active").attr("rnw-amount")
    let href = jQuery(this).attr("href")
    jQuery(this).attr("href", href + "/?rnw-amount=" + amount) 
    jQuery(this).click();
})