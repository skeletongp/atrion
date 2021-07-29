window.addEventListener('load', function () {
       

    let isChecked = true;;
    /* Controles del menú */
    $("#leftside-navigation .sub-menu > a").click(function (e) {
        $("#leftside-navigation ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(),
            e.stopPropagation()
    })
    $("#leftside-navigation .sub-menu2 > a").click(function (e) {
        $('#ul_sub1').toggle('', false);
        e.stopPropagation()
    })
    $("#leftside-navigation .sub-menu3 > a").click(function (e) {
        $('#ul_sub2').toggle('', false);
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
        $('#div-user').toggle('', false);
        $('#sp-plus').toggleClass('fa-plus fa-times');
    })

    /* Efetos visuales de añadir producto */
    $('#btn-add-product').click(function () {
        $('#div-table-product').toggle('', false);
        $('#div-add-product').toggle('', false);
        $('#sp-plus-product').toggleClass('fa-plus fa-times', 100);
    })

    /* Efectos visuales de añadir sucursal */
    $('#sp-add-place').click(function () {
        $('#div-places').toggle('', false);
        $('#div-add').toggle('', false);
        $('#sp-add-place').toggleClass('fa-plus fa-times', 300);

    })

    /* Desaparecer mensaje de éxito */

    Livewire.on('toggle-add-product', function () {
        try {
            $('.sp_product_added').toggle('', false);

        } catch (error) {
            console.log(error);
        }

    })

    /* Efectos visuales de la Client Card */
    $('#sp-client-invoices').click(function () {
        $('#div-client-invoices').toggle('', false);
        $('#sp-client-invoices').toggleClass('fa-eye fa-eye-slash', 400);


    })
    $('#btn-edit-client').click(function () {
        $('#div-edit').toggle('', false)
        $('#div-profile').toggle('', false)
        $('#sp-edit').toggleClass('fa-pen fa-times');
        if (!$('#div-account').is(':hidden')) {
            $('#div-account').toggle('', false)
        }
        if (!$('#div-invoices').is(':hidden')) {
            $('#div-invoices').toggle('', false);
        }
    })



    /* Importar productos desde Excel */
    $('#excel').on('change', function (e) {
        let file = $('#excel').prop('files')[0];
        console.log(file)
        let formData = new FormData();
        formData.append('file', file);
        $.ajax({
            url: 'products/upload', // <-- point to server-side PHP script 
            dataType: 'text',  // <-- what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            type: 'post',
            success: function (result) {
                alert( result);
                window.location.href = "/inventory/products"
            }
        });
    })
   
    function hideMessage(sp) {
        $(sp).slideUp();

    }
    $('.front').each(function () {
        $(this).click(function () {
            $(this).parent().toggleClass('rotar')
        })
    })
    $('.action').each(function () {
        $(this).click(function () {
            $(this).parent().parent().toggleClass('rotar')
        })
    })
    
        $('.draggable').draggable();
      
      /* Formatea los selects a select2 */
      $(".O").select2();

      /* Oculta el botón de editar cliente */
      $('#hide_select').hide('', false)

     
      /* Detecta la selección de producto y lo
      envía al método change del componente */
      $('.product_id').change(function() {
          var value = $('.product_id').select2("val");
          if (value != "") {
              Livewire.emit('change', value);
          }
      })

      /* Oculta el botón de editar cliente.
      Muestra/Oculta el select de cliente */
      $('#hide_select').click(function() {
          $('#div_select').toggle('', false)
          $('#hide_select').hide('', false)
      })

      /* Evento enter de los inputs para añadir
      producto a la factura */
      $('.enter_input').on('keypress', function(e) {
          if (e.which == 13) {
              $('#addDetail').trigger('click');
              $('#product_id').select2('open');
          }
      })

      /* Evento input del botón para cobrar */
      $('#input-payed').on('keypress', function(e) {
          if (e.which == 13) {
              $('#btn-facturar').trigger('click');
          }
      })

      /* Reinicia el select al añadir producto a factura */
      $('#addDetail').click(function() {
          $("#product_id").val('').trigger('change')
          console.log('false')

      })
})