$(document).ready(function() {
    $(document).on('click', '#checkAll', function() {
        $(".itemRow").prop("checked", this.checked);
    });
    $(document).on('click', '.itemRow', function() {
        if ($('.itemRow:checked').length == $('.itemRow').length) {
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }
    });
    var rowCount = 2;
    $(document).on('click', '#addRows', function() {
        var htmlRows = '';
        htmlRows += '<tr>';
        htmlRows += '<td style="padding: 20px 0 0 10px"><input class="itemRow" type="checkbox"></td>';
        htmlRows += '<td style="padding: 10px"><input value="" type="text" list="productCode" name="productCode[]"  id="productCode_' + rowCount + '" class="form-control" onchange="selectPrice(this.value, ' + rowCount + ')"></td>';
        htmlRows += '<td style="padding: 10px"><img src="" name="productImg[]" id="productImg_' + rowCount + '" class="invoiceImg"></td>';
        htmlRows += '<td style="padding: 10px" hidden><input name="productImg[]" id="productImgVal_' + rowCount + '" ></td>';
        htmlRows += '<td style="padding: 10px"><input type="text" readonly name="productName[]" id="productName_' + rowCount + '" class="form-control"></td>';
        htmlRows += '<td style="padding: 10px"><input type="number" min="1" name="quantity[]" id="quantity_' + rowCount + '" class="form-control"></td>';
        htmlRows += '<td style="padding: 10px"><input type="number" readonly min="1" name="price[]" id="price_' + rowCount + '" class="form-control"></td>';
        htmlRows += '<td style="padding: 10px"><input readonly name="totalRow[]" id="total_' + rowCount + '" type="number" min="1" class="form-control"></td>';

        htmlRows += '</tr>';
        rowCount++;
        $('#invoiceItem').append(htmlRows);
    });
    $(document).on('click', '#removeRows', function() {
        $(".itemRow:checked").each(function() {
            $(this).closest('tr').remove();
            rowCount--;
        });
        $('#checkAll').prop('checked', false);
        calculateSubtotal();
        calculateTotal();
    });
    $(document).on('blur', "[id^=quantity_]", function() {
        calculateSubtotal();
        calculateTotal();
    });
    $(document).on('blur', "[id^=price_]", function() {
        calculateSubtotal();
        calculateTotal();
    });
});

function selectPrice(val, id) {
    $.ajax({
        url: "selectPrice.php",
        type: "GET",
        data: { selectPrice: val, id: id },
        success: function(res) {
            res = JSON.parse(res);
            $('#price_' + id).val(parseFloat(res[0]));
            $('#productName_' + id).val(res[1]);
            $('#productImg_' + id).attr('src', "data/pro_img/" + res[2]);
            $('#productImgVal_' + id).val("data/pro_img/" + res[2]);
        }
    });
}

var subTotal;

function calculateSubtotal() {
    var totalAmount = 0;
    $("[id^='price_']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("price_", '');
        var price = $('#price_' + id).val();
        var quantity = $('#quantity_' + id).val();
        if (!quantity) {
            quantity = 1;
        }
        var total = price * quantity;
        $('#total_' + id).val(parseFloat(total));
        totalAmount += total;
    });
    subTotal = totalAmount;
    $('#subtotal').val(parseFloat(totalAmount));
}

function calculateTotal() {
    var discount = $('#discount').val();
    $('#total').val(subTotal - (subTotal / 100 * discount));
}

function calculateDebt() {
    var paid = $('#paid').val();
    var total = $('#total').val();
    $('#debt').val(total - paid);
}

// https://www.phpzag.com/build-invoice-system-with-php-mysql/