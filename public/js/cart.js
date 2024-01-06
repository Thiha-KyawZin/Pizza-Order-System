$(document).ready(function(){
    // Plus
    $('.btn-plus').click(function(){
        $parentdata = $(this).parents('tr');
        qtycalculation();
        totalcalculation();
    });
    // Minus
    $('.btn-minus').click(function(){
        $parentdata = $(this).parents('tr');
        qtycalculation();
        totalcalculation();
    });

    function qtycalculation(){
        $pizzaPrice = Number($parentdata.find('#pizzaprice').text().replace('Kyats','').replace(',',''));
        $qty = Number($parentdata.find('#qty').val());
        $updatePrice = $pizzaPrice * $qty;
        $parentdata.find('#total').text(`${$updatePrice.toLocaleString("en-US")} Kyats`);
    }

    function totalcalculation(){
        $totalPrice = 0;
        $('#pizzatable tbody tr').each(function(index,row){
           $totalPrice += Number($(row).find('#total').text().replace('Kyats','').replace(',',''));
        });
        $('#subtotal').text(`${$totalPrice.toLocaleString("en-US")} Kyats`);
        $('#finalPrice').text(`${($totalPrice + 2500).toLocaleString("en-US")} Kyats`);
    }


})
