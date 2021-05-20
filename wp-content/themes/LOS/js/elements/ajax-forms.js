jQuery(".los-ajax").on("submit", function(e){
    e.preventDefault();
    var form = jQuery(this);
    form.children(".form-alert").removeClass("show");
    form.children(".form-alert").removeClass("error");
    form.children(".form-alert").removeClass("success");
    form.children(".form-alert").text("");
    var formData = form.serialize();
    var interface = form.attr("data-interface");
    form.children(".lds-ellipsis").addClass("show")
    setTimeout(() => {
        jQuery.ajax({
            url : "/wp-content/themes/LOS/interfaces/" + interface + ".php",
            type: "POST",
            data : formData,
    
            success: function(response, textStatus, jqXHR) {
                console.log(response)
                if (response.type == "error") {
                    console.log(response)
                    form.children(".form-alert").text(response.text);
                    form.children(".form-alert").addClass(response.type);
                    form.children(".form-alert").addClass("show");
                    form.children(".lds-ellipsis").removeClass("show");
                } else if (response.type == "success") {
                    form.children(".form-alert").text(response.text);
                    form.children(".form-alert").addClass(response.type);
                    form.children(".form-alert").addClass("show");
                    form.children(".lds-ellipsis").removeClass("show");
                    form.children(".form-content").remove();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                  console.log(textStatus);
                  console.log(errorThrown);
            }
        });
    }, 500);
})


jQuery(".los-ajax[data-interface='member'] input[name='type']").on("change", function(){
    var newVal = jQuery(this).val();
    if (newVal == "couple") {
        jQuery(".info-couple").css("display", "block")
        jQuery(".info-couple").children().children("input").prop('required',true)
        jQuery("#couple-hr").css("display", "block")
    } else {
        jQuery(".info-couple").css("display", "none")
        jQuery("#couple-hr").css("display", "none")
        jQuery(".info-couple").children().children("input").prop('required',false)
    }

    if (newVal == "group") {
        jQuery("input[name='orga']").css("display", "block")
        jQuery("input[name='orga']").prop('required',true)
    } else {
        jQuery("input[name='orga']").css("display", "none")
        jQuery("input[name='orga']").prop('required',false)
    }
})

jQuery(".los-ajax[data-interface='activist'] input[name='support-type[]'][value='other']").on("change", function(){
    
    if (jQuery(this).is(":checked")) {
        jQuery("input[name='other-text']").css("display", "block")
        jQuery("input[name='other-text']").prop('required',true)
    } else {
        jQuery("input[name='other-text']").css("display", "none")
        jQuery("input[name='other-text']").prop('required',false)
    }
})