
$(document).ready(function(){
    const toggleBtnOne = $('.password-element .eye-icon');
    const toggleBtnTwo = $('.confirm-password-element .eye-icon');
    const passwordElemOne = $('.password-element .password');
    const passwordElemTwo = $('.confirm-password-element .password');

    toggleBtnOne.click(() => togglePasswordVisibility(toggleBtnOne, passwordElemOne));
    toggleBtnTwo.click(() => togglePasswordVisibility(toggleBtnTwo, passwordElemTwo));

    function togglePasswordVisibility(toggleBtn, passwordElem){
        const type = passwordElem.attr('type') === "password" ? "text" : "password";
        passwordElem.attr('type', type);
        if(type == "text") toggleBtn.html('<i class="fa-solid fa-eye"></i>');
        else toggleBtn.html('<i class="fa-solid fa-eye-slash"></i>');
    }

    // navbar toggler
    $('.page-navbar-toggler').click(function(){
        $('.page-navbar-collapse').addClass('show');
        $('.page-sidenav-overlay').addClass('show');
    });

    $('.page-navbar-close-btn').click(function(){
        $('.page-navbar-collapse').removeClass('show');
        $('.page-sidenav-overlay').removeClass('show');
    });

    $(document).click(function(e){
        if($(e.target).hasClass("page-sidenav-overlay")){
            $('.page-navbar-collapse').removeClass('show');
            $('.page-sidenav-overlay').removeClass('show');
        }
    });

    // view profile popup
    // $('#profile-view-btn').click(function(){
    //     $('.profile-popup').toggleClass('show');
    //     $('.popup-overlay').toggleClass('show');
    // });

    // $('#notification-view-btn').click(function(){
    //     $('.notify-popup').toggleClass('show');
    //     $('.popup-overlay').toggleClass('show');
    // })

    // file upload
    $("#upload-btn").click(function(){
        $("#upload-input").trigger('click');
    });


    $("#upload-input").change(event => {
        if(event.target.files){
            let filesAmount = event.target.files.length;
            $('.upload-img').html("");
            for(let i = 0; i < filesAmount; i++){
                let reader = new FileReader();
                reader.onload = function(event){
                    $($.parseHTML('<img class = "uploaded-img">')).attr('src', event.target.result).appendTo($(".upload-img"));

                }
                reader.readAsDataURL(event.target.files[i]);
            }
            $('.upload-file-name').text(filesAmount + " file(s) selected");
        }
    });

    // $("#upload-input").change(event => {
    //     if(event.target.files){
    //         let filesAmount = event.target.files.length;

    //         for(let i = 0; i < filesAmount; i++){
    //             let reader = new FileReader();
    //             reader.onload = function(event){
    //                 $($.parseHTML('<img class = "uploaded-img">')).attr('src', event.target.result).appendTo($(".upload-img"));
    //                 console.log(event.target.result, event.target.result);
    //             }
    //             reader.readAsDataURL(event.target.files[i]);

    //         }
    //     }
    //     // const reader = new FileReader();
    //     // reader.readAsDataURL(file);

    //     // reader.onloadend = () => {
    //     //     $('.upload-file-name').text(file.name);
    //     //     $('.upload-img img').attr('aria-label', file.name);
    //     //     $('.upload-img img').attr('src', reader.result);
    //     // }
    // });

    // $("#upload-input").change(event => {
    //     const file = event.target.files[0];
    //     const reader = new FileReader();
    //     reader.readAsDataURL(file);

    //     reader.onloadend = () => {
    //         $('.upload-file-name').text(file.name);
    //         $('.upload-img img').attr('aria-label', file.name);
    //         $('.upload-img img').attr('src', reader.result);
    //     }
    // });

    // profile image upload
    $(".profile-img-btn").click(function(){
        $("#profile-img-input").trigger('click');
    })

    $("#profile-img-input").change(event => {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = () => {
            $("#profile-img-view").attr('aria-label', file.name);
            $("#profile-img-view").attr('src', reader.result);
        }
    });

    // change active tab
    let navTabs = $('.sc-bookings .nav-tabs .nav-item');
    jQuery.each(navTabs, function(idx, navTab){
        $(navTab).click(function(){
            resetNavTabs();
            $(navTab).addClass('nav-item-active');
        });
    });

    const resetNavTabs = () => {
        jQuery.each(navTabs, function(idx, navTab){
            $(navTab).removeClass('nav-item-active');
        });
    }

    // event radio option selection

    $('.pick-venue-btn').click(function(){
        const eventRadioOptions = $('.venue-radio-options .form-check-input');
        jQuery.each(eventRadioOptions, function(idx, radioOption){
            if($(radioOption).is(":checked")){
                let radioOptionValue = $(radioOption).next().text();
                $('.venue-form-control').val(radioOptionValue);
            }
        });
    });

    $('.pick-venue-btn').click(function(){
        $('.venue-radio-options').removeClass('show');
    });

    $('.venue-form-control').focus(function(){
        $('.venue-radio-options').addClass('show');
    });

    $(document).on('click', function(event){
        let trigger = $('.booking-selection-item');
        if(trigger !== event.target && !trigger.has(event.target).length){
            $('.venue-radio-options').removeClass('show');
        }
    });

    // gallery view
    const galleryCards = $('.gallery-cards .gallery-card');
    jQuery.each(galleryCards, function(idx, card){
        $(card).click(function(){
            $('.gallery-modal').addClass('show');
        });
    });

    $('.gallery-modal-close-btn').click(function(){
        $('.gallery-modal').removeClass('show');
    });

    const galleryModalThumbnails = $('.img-thumbnails .thumbnail-item');
    const galleryImgPreviewBox = $('.img-preview');

    jQuery.each(galleryModalThumbnails, function(idx, thumbnail){
        $(thumbnail).click(function(){
            let imgSrc = $(thumbnail).find('img').attr('src');
            $(galleryImgPreviewBox).find('img').attr('src', imgSrc);
        });
    });

    // date picker for booking page
    $('.check-in-datepicker').datepicker();
    $('.check-out-datepicker').datepicker();
});
