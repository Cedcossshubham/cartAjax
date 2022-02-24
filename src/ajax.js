$(document).ready(function(){

    $.ajax({
        url: 'config.php',
        method: 'POST',
        data: {'action':'onload'},
        dataType:'JSON'
    }).done(function(response){
        displaylist(response);
    });

    
    $(document).on('click','#add-to-cart',function(e){
        e.preventDefault();
        $.ajax({
            url: 'config.php',
            method: 'POST',
            data: {'id': $(this).data('id'), 'action':'add'},
            dataType:'JSON'
        }).done(function(response){
           displaylist(response);
        });

    });


    $(document).on('click','#removeProduct',function(e){
        e.preventDefault();
        console.log("remove product"+$(this).data('id'));
        $.ajax({
            url: 'config.php',
            method: 'POST',
            data: {'id': $(this).data('id'), 'action':'remove'},
            dataType:'JSON'
        }).done(function(response){
            displaylist(response);
        });

    });
    

    function displaylist(response){
        var table ="";
        table += "<table><tr><th>Product Id</th><th>Product Name</th><th>Product Price</th><th>Product Qnty</th><th>Total Price</th><th>Remove</th></tr>";
        for(var key in response){
            table +=   '<tr><td>'+response[key]['id']+'</td>\
                        <td>'+response[key]['name']+'</td>\
                        <td>'+response[key]['price']+'</td>\
                        <td>'+response[key]['qnty']+'</td>\
                        <td>'+response[key]['tPrice']+'</td>\
                        <td><a class="add-to-cart" data-id="'+response[key]['id']+'" id ="removeProduct" href="products.php?id='+response[key]['id']+'&action=removeProduct" >X</a></td>\
                        </tr>';
        }
        table += '</table>';
        $('#cart').html(table);

    }

});