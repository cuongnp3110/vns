function openChat() {
    document.getElementById("chatBox").style.display = "block";
    document.getElementById("userText").focus();
}

function closeChat() {
    document.getElementById("chatBox").style.display = "none";
}

$(document).ready(function() {
    $(document).on('submit', '#formChat', function() {
        var userText = document.getElementById("userText").value;
        if (userText != "") {
            var addUserText = '<div class="textBoxUser">' + userText + '</div>';
            $('#chatArea').append(addUserText);
            $('#userText').val('');
            document.getElementById("tidot").hidden = false;
            updateScroll();
            output(userText);
        }
        return false;
    });
});

function updateScroll() {
    var scroll = document.getElementById("chatArea");
    scroll.scrollTop = scroll.scrollHeight;
}

function send() {
    var userText = document.getElementById("userText").value;
    if (userText != "") {
        var addUserText = '<div class="textBoxUser">' + userText + '</div>';
        $('#chatArea').append(addUserText);
        $('#userText').val('');
    }
}

function output(input) {
    let product = "";
    let text = input.toLowerCase().replace(/[^\w\s\d]/gi, "");
    text = text
        .replace(/ a /g, " ")
        .replace(/whats/g, "what is")
        .replace(/please /g, "")
        .replace(/ please/g, "")
        .replace(/cmon/g, "come on")
        .replace(/r u/g, "are you")
        .replace(/idk/g, "i dont know")
        .replace(/cant/g, "can not")
        .replace(/create/g, "add")
        .replace(/error message/g, "error")
        .replace(/error/g, "")
        .replace(/types/g, "type")
        .replace(/downloading/g, "download")
        .replace(/exporting/g, "export")
        .replace(/saving/g, "save")
        .replace(/editing/g, "edit")
        .replace(/deleting/g, "delete")
        .replace(/printing/g, "print")
        .replace(/invoices/g, "invoice")
        .replace(/existed/g, "exist")
        .replace(/change/g, "edit")
        .replace(/products/g, "product")
        .replace(/avt/g, "avatar")
        .replace(/traded/g, "trade")
        .trim();

    if (compare(utterances, answers, text)) {
        product = compare(utterances, answers, text);
        addChatEntry(product);
    } else if (text == "number of product" || text == "total product" || text == "product total" || text == "amount of product" || text == "product amount") {
        $.ajax({
            url: "bot_data.php",
            type: "GET",
            data: { product_count: 1 },
            success: function(res) {
                res = JSON.parse(res);
                product = "Total amount of product: " + res;
                addChatEntry(product);
            }
        });
    } else if (text == "number of product being trade" || text == "total trading product" || text == "trading product total" || text == "amount of trading product" || text == "trading product amount") {
        $.ajax({
            url: "bot_data.php",
            type: "GET",
            data: { product_trade_count: 1 },
            success: function(res) {
                res = JSON.parse(res);
                product = "Number of for sale product: " + res;
                addChatEntry(product);
            }
        });
    } else if (text == "number of customer" || text == "total customer" || text == "customer total" || text == "amount of customer" || text == "customer amount") {
        $.ajax({
            url: "bot_data.php",
            type: "GET",
            data: { customer_count: 1 },
            success: function(res) {
                res = JSON.parse(res);
                product = "Number of customer: " + res;
                addChatEntry(product);
            }
        });
    } else if (text == "number of supplier" || text == "total supplier" || text == "supplier total" || text == "amount of supplier" || text == "supplier amount") {
        $.ajax({
            url: "bot_data.php",
            type: "GET",
            data: { product_count: 1 },
            success: function(res) {
                res = JSON.parse(res);
                product = "Number of supplier: " + res;
                addChatEntry(product);
            }
        });
    } else if (text == "number of category" || text == "total category" || text == "category total" || text == "amount of category" || text == "category amount") {
        $.ajax({
            url: "bot_data.php",
            type: "GET",
            data: { category_count: 1 },
            success: function(res) {
                res = JSON.parse(res);
                product = "Number of category: " + res;
                addChatEntry(product);
            }
        });
    } else if (text == "number of brand" || text == "total brand" || text == "brand total" || text == "amount of brand" || text == "brand amount") {
        $.ajax({
            url: "bot_data.php",
            type: "GET",
            data: { category_count: 1 },
            success: function(res) {
                res = JSON.parse(res);
                product = "Number of brand: " + res;
                addChatEntry(product);
            }
        });
    } else if (text == "number of export invoice" || text == "total export invoice" || text == "export invoice total" || text == "amount of export invoice" || text == "export invoice amount") {
        $.ajax({
            url: "bot_data.php",
            type: "GET",
            data: { ex_invoice_count: 1 },
            success: function(res) {
                res = JSON.parse(res);
                product = "Number of export invoice: " + res;
                addChatEntry(product);
            }
        });
    } else if (text == "number of import invoice" || text == "total import invoice" || text == "import invoice total" || text == "amount of import invoice" || text == "import invoice amount") {
        $.ajax({
            url: "bot_data.php",
            type: "GET",
            data: { im_invoice_count: 1 },
            success: function(res) {
                res = JSON.parse(res);
                product = "Number of import invoice: " + res;
                addChatEntry(product);
            }
        });
    } else if (text == "best seller product" || text == "best selling product") {
        $.ajax({
            url: "bot_data.php",
            type: "GET",
            data: { best_seller: 1 },
            success: function(res) {
                res = JSON.parse(res);
                alert(res);
                product = "Its " + res[0][0] + " with " + res[0][1] + " sale unit(s)";
                addChatEntry(product);
            }
        });
    } else {
        product = alternatives[Math.floor(Math.random() * alternatives.length)];
        $.ajax({
            url: "bot_data.php",
            type: "GET",
            data: { data: text },
            success: function() {
                return true;
            }
        });
        addChatEntry(product);
    }
}

function compare(utterancesArray, answersArray, string) {
    let reply;
    let replyFound = false;
    for (let x = 0; x < utterancesArray.length; x++) {
        for (let y = 0; y < utterancesArray[x].length; y++) {
            if (utterancesArray[x][y] === string) {
                let replies = answersArray[x];
                reply = replies[Math.floor(Math.random() * replies.length)];
                replyFound = true;
                break;
            }
        }
        if (replyFound) {
            break;
        }
    }
    return reply;
}

function addChatEntry(product) {
    document.getElementById("userText").readOnly = true;
    setTimeout(() => {
        var addBotText = '<div class="textBoxBot">' + product + '</div>';
        $('#chatArea').append(addBotText);
        document.getElementById("tidot").hidden = true;
        document.getElementById("userText").readOnly = false;
        updateScroll();
    }, 1500);

}