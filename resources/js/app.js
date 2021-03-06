import './admin/libs';
import slick from 'slick-carousel';

import 'select2/dist/js/i18n/zh-TW.js';


$(() => {
    $( document ).ready(function() {

        if($('.custom-editor').length){
            $('.custom-editor').summernote({
                placeholder: 'Hello Bootstrap 4',
                tabsize: 2,
                height: $('.custom-editor').attr('data-weight'),
            });
        }
        $('.select2').select2({
            placeholder:"enter keyword",
            allowClear: true
        });
        $('.select2-limit').select2({
            maximumSelectionLength: 2,
        });
        $('.select2-limit-zhTW').select2({
            language:'zh-TW',
            maximumSelectionLength: 1,
        });
        $('.select2-min-input-length').select2({
            minimumInputLength: 2
        });
        $('.select2-max-input-length').select2({
            maximumInputLength: 4
        });

        $('.slider').slick({
            prevArrow:'<button type="button" class="slick-prev"></button>',
            nextArrow:'<button type="button" class="slick-next"></button>',
            dots: true,
        });
        $('.slider-multi').slick({
            prevArrow:'<button type="button" class="slick-prev"></button>',
            nextArrow:'<button type="button" class="slick-next"></button>',
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
        $('.slider-fade').slick({
            prevArrow:'<button type="button" class="slick-prev"></button>',
            nextArrow:'<button type="button" class="slick-next"></button>',
            fade: true,
        });
        $('.slider-syncing').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            prevArrow:'<button type="button" class="slick-prev"></button>',
            nextArrow:'<button type="button" class="slick-next"></button>',
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-syncing',
            dots: true,
            centerMode: true,
            focusOnSelect: true
        });
        $('.slider-autoplay').slick({
            slidesToScroll: 1,
            autoplay: true,
            arrows: false,
            autoplaySpeed: 1000,
        });

        $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            $('.slider').slick('refresh');
            $('.slider-multi').slick('refresh');
            $('.slider-fade').slick('refresh');
            $('.slider-syncing').slick('refresh');
            $('.slider-nav').slick('refresh');
            $('.slider-autoplay').slick('refresh');
        });

    });



    //???????????????????????????
    let $form = $('.validation-form');
    function focusField(element) {//??????????????????
        let tabId = $(element).closest('.tab-pane').attr('aria-labelledby')
        $('#' + tabId).tab('show');
        $(window).scrollTop($(element).offset().top - $(window).height() / 2);
        $(element).focus();
    }
    function showValidationMessage(element, message) {//??????????????????
        removeValidationMessage();
        $(element).addClass('required-error');
        $('<div>').addClass('required-error-message text-danger').html(message).insertAfter(element)
    }
    function removeValidationMessage() {//??????????????????
        $('.required-error-message').remove();
        $('.required-error').removeClass('required-error');
    }
    $(document.body).on('change','.required-error',function (){//???????????????????????????????????????
        removeValidationMessage();
    });

    $form.on('submit', e => {//???????????????????????????
        // ???????????????????????????
        let invalid = false;
        $('.form-required').each((index, ele) => {
            if(!$(ele).val()) {
                invalid = true;
                focusField(ele);
                showValidationMessage(ele, '???????????????');
                return false;
            }
        });
        if(invalid) {
            return false;
        }
        $('#notification-message').show();
        return false;
    });
})
