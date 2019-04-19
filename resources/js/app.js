/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//
// window.Vue = require('vue');
//
// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */
//
// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// const app = new Vue({
//     el: '#app'
// });

$('document').ready(function () {

    $checkbox = $('#bookable');

    $deactivate = $('#deactivate');

    $kit = $('#kit_name');

    //Disable the select input
    $checkbox.click(function () {
        if ($(this).is(':checked')) {
            $kit.removeAttr('disabled');
        } else {
            $kit.attr('disabled', true);
        }
    });

    /*=======================DELETE KIT==========================*/

    //Set all the headers to contain the CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $deleteBtn= $('.deleteKit');

    //Submit the form and check the deletion.
    $modal = $('#exampleModalCenter');
    $cancelModal = $('#cancelModalCenter');

    $('.deleteKit').on('click', (ev) => {
        ev.preventDefault();
        const $buttonClicked = $(ev.target);
        hasProduct($buttonClicked);
    });

    /*
    * Deletes the kit from the database
    *
    * @params the button that was clicked
    * */
    function deleteKit($target) {
        $.post($target.attr('href'), {_method: "DELETE"})
            .done((data) => {
                //Close the model and remove the tr
                $modal.modal('hide');
                $target.closest('tr').remove();
            })
            .fail((jqXHR) => {
                //Print out an error
                alert("Error: " + jqXHR.responseText);
            });
    }


    /*
    * Check if the kit has any product before deleting
    *
    * @param $target
    * @return response
    *
    * */
    function hasProduct($target) {
        //Split the url and get the id out of it
        let url = $target.attr('href').split('/');
        const id = url[url.length - 1];
        $.post('kits/checkProduct/' + id)
            .done((data) => {
                if (data) {
                    $modal.modal('show');
                    $('#yes').click(() => {
                        deleteKit($target);
                    });
                } else {
                    deleteKit($target);
                }
            })
            .fail((jqXHR) => {
                alert("Error:: " + jqXHR.responseText);
            });
    }


    /*
    * This code will make sure the user is sure to cancel the user
    *
    * Will pop up a modal box and ask user to confirm
    * */
    let $cancelBtn = $(".cancelBooking");
    $cancelBtn.on('submit', function (ev) {
        ev.preventDefault();
        const $this = $(this);
        $cancelModal.modal('show');
        $('#yes').on('click', function () {
            $.post($this.attr('action'), {_method: 'DELETE'})
                .done(function (data) {
                    $cancelModal.modal('hide');
                    $this.closest('tr').remove();
                })
                .fail((jqXHR) => {
                    alert('Error:: ' + jqXHR.responseText);
                })

        })
    })
});
