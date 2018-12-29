var validatro = validatename = validatemail = validatephone = validatecpass =false ;
$(document).ready(function () {
    var $regexname = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,50}$/;
    var $regexemail = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/;
    var $regexphone = /^[0-9]{9}$/;
    // /^([a-zA-Z]{3,16})$/
    $("form input[name='name']").on('keypress keydown keyup', function () {
        if (!$(this).val().match($regexname)) {
            // there is a mismatch, hence show the error message
            $("span[name='name']").removeClass('hidden');
            $("span[name='name']").show();
            validatename = false;
        }
        else {
            // else, do not display message
            $("span[name='name']").addClass("hidden");
            validatename = true;
        }
    });

    $("form input[name='email']").on("keypress keydown keyup", function() {
        if (!$(this)
                .val()
                .match($regexemail)) {
            // there is a mismatch, hence show the error message
            $("span[name='email']").removeClass("hidden");
            $("span[name='email']").show();
            validatemail = false;
        } else {
            // else, do not display message
            $("span[name='email']").addClass("hidden");
            validatemail = true;
        }
    });

    $("form input[name='phone_number']").on("keypress keydown keyup", function () {
        if (!$(this)
            .val()
            .match($regexphone)) {
            // there is a mismatch, hence show the error message
            $("span[name='phone_number']").removeClass("hidden");
            $("span[name='phone_number']").show();
            validatephone = false;
        } else {
            // else, do not display message
            $("span[name='phone_number']").addClass("hidden");
            validatephone = true;
        }
    });

    $("form input[name='c_password']").on("keypress keydown keyup", function() {
        if (!($(this).val() == $("form input[name='password']").val())) {
                // there is a mismatch, hence show the error message
                $("span[name='c_password']").removeClass("hidden");
                $("span[name='c_password']").show();
                validatecpass = false;
            } else {
                // else, do not display message
                $("span[name='c_password']").addClass("hidden");
                validatecpass = true;
            }
    });

    $('form[name="register_user"]').submit(function () {
        validator = (validatename && validatemail && validatephone && validatecpass);
        if (!validator) {
            console.log(validator);
            alert("Some of the fields are not valid.");
            return false;
        }
        return true;
    });
});