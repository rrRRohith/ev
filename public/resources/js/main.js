/**
 * Ajax init setup
 */
$(document).ready(function () {
    $.ajaxSetup({ cache: false });
    toolTip();
});
/**
 * Pop global login form
 */
const popLogin = function () {
    $('#loginModal').modal('show');
}
/**
 * Ajax form submission
 * Return to form callback on success
 */
$('document').ready(function () {
    $(document).on('submit', 'form.ajax', async function (e) {
        e.preventDefault();
        let $form = $(this);
        let continueBTN = $(`.continue-btn[form=${$form.attr('id')}]`);
        continueBTN.startLoading();
        try {
            await $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                //data: $form.serialize(),
                data: new FormData( this ),
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.success) {
                        if ($form.attr('data-callback'))
                            window[$form.attr('data-callback')](data);
                        else
                            formSuccess($form, data);
                    } else {
                        makeError()
                    }

                },
                error: function (data) {
                    makeError(data, $form);
                }
            });
        } catch (e) { }
        continueBTN.stopLoading();
    });
});
/**
 * Custom button loader for form submissions
 */
$(function () {
    $.fn.startLoading = function (args) {
        swal.close();
        $(this).each(function () {
            $(this).html(`<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>`).attr('disabled', true);
        })
        return this;
    };
    $.fn.stopLoading = function (args) {
        $(this).each(function () {
            $(this).html($(this).attr('data-default')).removeAttr('disabled', true);
        })
        return this;
    };
})
/**
 * Make ajax error
 * @param {*} data 
 * @returns 
 */
const makeError = function (data = null) {
    if (data && data.responseJSON)
        return handleAPIErrors(data.responseJSON);
    else
        toast('Something went wrong, please try again later.', 'warning');
}

/**
 * Handle ajax API errors
 * @param {*} result 
 */
const handleAPIErrors = async function (result) {
    $('.form-group').removeClass('error');
    let html = '';
    await $.each(result.data, function (key, values) {
        $.each(values, function (i, error) {
            html += `<p>${error}</p>`;
        })
        let keyNames = key.split(".");
        let keyName = keyNames[0];
        keyNames.shift();
        keyNames.forEach(function (v) {
            keyName += `[${v}]`;
        });
        try {
            if (!$('.form-control').is(':focus'))
                $(`[name="${keyName}"]`).focus().scrollTo();
            $(`[name="${keyName}"]`).closest('.form-group').addClass('error').attr('data-error', values[0]);
        }
        catch (e) { console.log(e) }
    });
    html = `<div class="APIerrors">${html}</div>`;
    toastAPIError(result.message, html);
    try {
        if (result.redirect) {
            await sleep(300);
            window.location = result.redirect;
        }
    }
    catch (e) { }
}

/**
 * Remove input errors in form submission
 */
$(document).on('submit', 'form', function () {
    $(this).find('.form-group').removeClass('error');
})
/**
 * Remove input errors in form input
 */
$(document).on('change', '.form-group.error *', function () {
    $(this).closest('.form-group').removeClass('error');
})
/**
 * Custom bs tooltips
 */
const toolTip = function () {
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            'customClass': 'menu-tooltip'
        })
    })
}
/**
 * Create sweet alert toast message
 * @param {*} message 
 * @param {*} type 
 */
const toast = function (message, type) {
    Swal.fire({
        toast: true,
        title: message,
        position: 'bottom',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
        showCloseButton: true,
        customClass: {
            container: `c-toast ${type}`,
        },
    });
}
/**
 * Toast API error messages.
 * @param {*} message 
 * @param {*} html 
 */
const toastAPIError = function (message, html = null) {
    Swal.fire({
        toast: true,
        title: message,
        html: html,
        position: 'bottom',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: false,
        showCloseButton: true,
        customClass: {
            container: 'c-toast error',
        },
    });
}
/**
 * Scroll to element
 */
jQuery.fn.extend({
    scrollTo: function () {
        var x = jQuery(this).offset().top - 100;
        jQuery('html,body').animate({ scrollTop: x }, 500);
    }
});

const formSuccess = function ($form = null, data = null) {
    if ($form) {
        if ($form.attr('data-reload')) {
            location.reload();
        }
        if ($form.attr('data-reset')) {
            $form.trigger('reset');
        }
        if ($form.attr('data-modal')) {
            $(`.continue-btn[form="${$form.attr('id')}"]`).closest('.modal').modal('hide');
        }
        $form.find('.form-group').removeClass('error');
        $form.find('.reset-value').val('');
        $('.reset-value').val('');
        $('.form-group').removeClass('error');
    }
    if (data && data.success && data.message) {
        toast(data.message, 'success');
    }
    else if (data && !data.success && data.message) {
        toast(data.message, 'error');
    } else if (data && !data.success) {
        makeError()
    }
    if ($form && $form.attr('data-redirect') == 'false') {
        return false;
    }
    else if (data && data.redirect)
        window.location.href = data.redirect;
    return;
}

function round(num, decimalPlaces) {
    var p = Math.pow(10, decimalPlaces);
    var e = Number.EPSILON * num * p;
    return Math.round((num * p) + e) / p;
}

function secondsToDhms(seconds) {
    seconds = Number(seconds);
    var d = Math.floor(seconds / (3600*24));
    var h = Math.floor(seconds % (3600*24) / 3600);
    var m = Math.floor(seconds % 3600 / 60);
    var s = Math.floor(seconds % 60);
    
    var dDisplay = d > 0 ? d + (d == 1 ? " day, " : " days, ") : "";
    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
    return (dDisplay + hDisplay + mDisplay).replace(/,\s*$/, "");;
    }