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

    $('.deleteKit').on('click', (ev) => {
        ev.preventDefault();
        const $buttonClicked = $(ev.target);
        hasProduct($buttonClicked);
    });

    //Deletes the kit
    function deleteKit($target){
        $.ajax({
            url: $target.attr('href'),
            type: 'POST',
            data: {
              "_method": "DELETE"
            },
            success: () => {
                $modal.modal('hide');
                $target.closest('tr').remove();
            }
        });
    }

    //Check if it has any products
    function hasProduct($target){
        let url = $target.attr('href').split('/');
        $.ajax({
            type: 'POST',
            url: "kits/checkProduct/" + url[url.length - 1],
            success: (response) => {
                if(response == 1){
                    $modal.modal('show');
                    $('#yes').click(()=>{
                        deleteKit($target);

                    });
                }else{
                    deleteKit($target);
                }

            }
        });
    }
});
