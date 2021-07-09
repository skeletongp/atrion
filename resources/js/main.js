window.addEventListener('load', function () {
    let isChecked = true;;
    /* Controles del menú */
    $("#leftside-navigation .sub-menu > a").click(function (e) {
        $("#leftside-navigation ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(),
            e.stopPropagation()
    })
    $('#input-menu').on('change', function () {
        $('#lb-open').toggle('', false);
        $('#lb-close').toggle('', false);
        $('#sidebar').toggle('', false);
        isChecked = $('#input-menu').prop('checked');

    })
    if ($(window).width() < 770 && isChecked) {
        $('#lb-close').trigger('click');
    }
    $(window).resize(function () {
        if ($(window).width() < 770 && isChecked) {
            $('#lb-close').trigger('click');
        }
        if ($(window).width() > 770 && !isChecked) {
            $('#lb-open').trigger('click');
        }

    });

    /* Función para cerrar sesión */
    var button = document.getElementById('sub2');
    button.onclick = function () {
        document.getElementById("form2").submit();
    }

    /* Cerrar el menú al hacer click fuera de él */
    $('#main').on('click', function () {
        if (isChecked && $(window).width() < 770) {
            $('#lb-close').trigger('click');
        }
    })
    $('header').on('click', function () {
        if (isChecked && $(window).width() < 770) {
            $('#lb-close').trigger('click');
        }
    })
    /* Efectos visuales de añadir usuario */
    $('#btn-adduser').click(function () {
        $('#div-table').toggle('', false);
        $('#div-links').toggle('', false);
        $('#div-form').toggle('', false);
        $('#div-title').toggle('', false);
        $('#div-botones').toggleClass('w-full');
        $('#div-search').toggle('', false);
        $('#sp-plus').toggleClass('fa-plus fa-times');
    })

    /* Efetos visuales de añadir producto */
    $('#btn-add-product').click(function () {
        $('#div-table-product').toggle('', false);
        $('#div-add-product').toggle('', false);
        $('#sp-plus-product').toggleClass('fa-plus fa-times', 100);
    })

    /* Desaparecer mensaje de éxito */

    Livewire.on('toggle-add-product', function () {
        try {
            $('.sp_product_added').toggle('', false);
            
        } catch (error) {
            console.log(error);
        }

    })
    
   
    
})