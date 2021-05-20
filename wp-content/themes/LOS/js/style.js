var styleSets = function styleSets() {
    var vh = window.innerHeight * 0.01;
    var vw = jQuery(document).width() * 0.01;
    document.documentElement.style.setProperty("--vh", `${vh}px`);
    document.documentElement.style.setProperty("--vw", `${vw}px`);

    if (jQuery(document).width() > 1245) {
        var mcpad = (jQuery(document).width() - 1120) / 2;
    }
    else {
        var mcpad = 5 * vw;
    }
    document.documentElement.style.setProperty("--mcpad", `${mcpad}px`);
    let mcont = jQuery(document).width() - 2 * mcpad;
    let rem = parseFloat(getComputedStyle(document.documentElement).fontSize);
    let colwid = (mcont - (4 * rem)) / 3;
    document.documentElement.style.setProperty("--colwid", `${colwid}px`);
    let scolwid = (mcont - (8 * rem)) / 3;
    document.documentElement.style.setProperty("--scolwid", `${scolwid}px`);

    jQuery(".aspect-ratio").each(function(){
        if (jQuery(document).width() > jQuery(this).attr("ar-min")) {
            jQuery(this).css("height", (jQuery(this).innerWidth() / jQuery(this).attr("ar-width") * jQuery(this).attr("ar-height")) + "px")
        }
    })
}

window.addEventListener("load", styleSets, false);
window.addEventListener("resize", styleSets, false);