

$(document).ready(function()
{
    console.log('Menu Nav PHP..' + '<?php echo $header ?>' +'..');
});


$(document).off('click', 'ul.menu-nav li a');
$(document).on('click', 'ul.menu-nav li a', function ()
{
    var selText = $(this).text();
    var dataUrl = $(this).attr("data-url");
    console.log(dataUrl);

    if (dataUrl == "")
    {
        return;
    }

    var idUser = $("#idSessionUser").val();

    $.ajax({
        url: dataUrl, 
        type: 'POST',
        data:{
            idUser : idUser
        },
        success: function(response)
        {
            if (selText === 'Salir') {
                $("#containerPage").html(response);
            } else {
                $("#containerBody").html(response);
            }
            
            bs_input_file();

        },error: function(response,status,error)
        {
            showModal(response.responseText);
        }
    });
});

 /* Manu Home */
$(document).off('click', '#menuNavHome');
$(document).on('click', '#menuNavHome', function ()
{
    console.log('dropdown-menu menu-nav');
    var selText = $(this).text();
    var dataUrl = $(this).attr("data-url");
    console.log(dataUrl);

    if (dataUrl == "")
    {
        return;
    }

    $.ajax({
        url: dataUrl, 
        type: 'POST',
        data:{},
        success: function(response)
        {
            $("#containerBody").html(response);
        },error: function(response,status,error){
            showModal(response.responseText);
        }
    });
});
