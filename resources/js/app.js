
require('@tabler/core');
//require('bootstrap');
window.$ = window.jQuery = require('jquery');
require('jquery-toast-plugin');
require('jquery-mask-plugin');
require('dropify/dist/js/dropify');
const { data } = require('jquery');

import swal from 'sweetalert2';
window.Swal = swal;

import 'jquery-ui/ui/widgets/draggable.js';
import 'jquery-ui/ui/widgets/sortable.js';

//
$(function () {
    $(document).on('click', 'a.load-onlick', function (event) {
        $(this).addClass('disabled').html('<span class="spinner-border spinner-border-sm" role="status"></span>');
    })
    $('form.spinner').on('submit', function () {
        $('button[type=submit]').addClass('disabled').html('<span class="spinner-border spinner-border-sm" role="status"></span>');
    });
    $(document).on('click', 'a.remove', function (e) {
        e.preventDefault();
        var _this = $(this);
        Swal.fire({
            title: 'Atenção!',
            text: _this.attr('title'),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#206bc4',
            cancelButtonColor: '#656d77',
            confirmButtonText: 'Sim'
        }).then((result) => {
            if (result.isConfirmed) {
                _this.addClass('disabled').html('<span class="spinner-border spinner-border-sm" role="status"></span>');
                $.ajax({
                    type: "DELETE",
                    url: _this.attr('href'),
                    data: { '_token': $('meta[name=csrf-token]').attr("content") }
                }).done(function (data) {
                    $.toast(data.msg);
                    if (_this.data('target-remove') == 'tr') {
                        $(_this).closest(_this.data('target-remove'))
                            .children('td')
                            .animate({ padding: 0 })
                            .wrapInner('<div />')
                            .children()
                            .slideUp(function () {
                                $(this).closest('tr').remove();
                            });
                    } else {
                        location.reload();
                    }
                }).fail(function (data) {
                    $.toast({
                        heading: 'Erro!',
                        text: 'Contate o Administrador.',
                        icon: 'error'
                    });
                });
            }
        })
    });
});
