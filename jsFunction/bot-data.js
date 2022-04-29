const utterances = [
    //General
    ["how are you", "how is life", "how are things"], //0 hỏi thăm xã giao
    ["hi", "hey", "hello", "good morning", "good afternoon"], //1 chào
    ["what are you doing", "what is going on", "what is up"], //2 hỏi thăm xã giao
    ["how old are you"], //3 hỏi thăm xã giao
    ["who are you", "are you human", "are you bot", "are you human or bot", "who are you"], //4 hỏi về chatbot
    ["good", "nice", "oke", "ok", "fine", "well done", "excellent", "awesome", "hilarious", "you are good", "wow", "got it",
        "i got it", "oke i got it", "i understand", "of course thank you", "of course"
    ], //5 khen
    ["you are bad", "you are stupid", "suck", "you suck", "bad robot", "bad ai", "not good", "fuck", "fuck you", "kiss my ass", "so stupid",
        "you are not good", "how can you be that bad", "shut up", "fuck off"
    ], //6 chê
    ["validate rule", "validation", "validate", "valid information", "image format", "image format rule", "format of image",
        "incorrect input", "i dont know why my input is incorrect", "why my input is incorrect", "incorrect input", "incorrect form", "error",
    ], //8 lỗi chung chung
    ["oke bye", "thanks you", "oke see you", "see you again", "good bye", "bye"], //tạm biệt


    //Product
    ["product already exist", "product is existed", "existed product"], //1
    ["image inappropriate"], //2
    ["image aspect ratio is inappropriate", "inappropriate aspect ratio"], //3
    ["how can i add new product", "product function", "function product", "how to add product", "how to add new product", "add product", "add new product",
        "i want to add new product", "i want to add product", "product", "product list", "list of product"
    ], //4
    ["how to edit product", "edit product", "i want to edit new product"], //5
    ["how to delete product", "delete product", "i want to delete new product"], //6
    ["how do you store my product image", "the way you store my product image", "process of storing product image", "image storing process"], //7
    ["what is product name", "product name declaration", "product name"], //8
    ["what is product code", "product code declaration", "product code", "what is code", "code declaration", "code"], //9
    ["what is product color", "product color declaration", "product color", "what is color", "color declaration", "color"], //10
    ["what is product brand", "product brand declaration", "product brand", "brand name", "brand"], //11
    ["what is product category", "product category declaration", "product category", "category"], //12
    ["what is normal price", "normal price declaration", "normal price", "what product is normal price", "product normal price declaration", " product normal price"], //13
    ["what is product discount", "product discount declaration", "product discount", "what is discount", "discount declaration", "discount"], //14
    ["what is product describe", "product describe declaration", "product describe"], //15


    //Cat Brand
    ["how can i add new category", "category function", "function category", "how to add category", "how to add new category", "add category", "add new category", "i want to add new category", "i want to add category"], //1
    ["how can i add new brand", "brand function", "function brand", "how to add brand", "how to add new brand", "add brand", "add new brand", "i want to add new brand", "i want to add brand"], //2
    ["how can i edit category", "how to edit category", "edit category", "i want to edit category"], //3
    ["how can i edit brand", "how to edit brand", "edit brand", "i want to edit brand"], //4
    ["how can i delete category", "how to delete category", "delete category", "i want to delete category"], //5
    ["how can i delete brand", "how to delete brand", "delete brand", "i want to delete brand"], //6
    ["category exist", "existed category", "existed product"], //7
    ["brand exist", "existed brand", "existed brand"], //8


    //Invoice
    ["type of invoice", "invoice type", "how many type of invoice", "invoice declaration", "invoice"], //1
    ["what is import invoice", "import invoice", "import invoice declaration"], //2
    ["what is export invoice", "export invoice", "export invoice declaration"], //3
    ["how can i add new invoice", "how can i use invoice", "how to use invoice", "invoice function", "function invoice", "how to add invoice", "how to add new invoice", "add invoice", "add new invoice", "i want to add new invoice", "i want to add invoice",
        "how can i add new import invoice", "how to add import invoice", "how to add new import invoice", "add import invoice", "add new import invoice", "i want to add new import invoice", "i want to add import invoice",
        "how can i add new export invoice", "how to add export invoice", "how to add new export invoice", "add export invoice", "add new export invoice", "i want to add new export invoice", "i want to add export invoice"
    ], //4
    ["what is sub total", "what is subtotal", "sub total declaration", "subtotal declaration", "subtotal", "sub total"], //5
    ["what is discount", "discount declaration", "discount", "what is discount %", "discount declaration %", "discount%"], //6
    ["what is paid", "paid declaration", "paid"], //7
    ["what is dept", "dept declaration", "dept"], //8
    ["what is notes", "notes declaration", "notes", "what is note", "note declaration", "note"], //9
    ["discount value is require", "required discount"], //10
    ["paid value is required", "required paid"], //11
    ["paid value is invalid", "invalid paid"], //12
    ["input value is invalid", "invalid input value"], //13
    ["how to down load invoice", "how to export invoice", "invoice download", "invoice export", "invoice save", "download invoice",
        "download invoice pdf", "download pdf invoice", "print invoice", "invoice printer", "export invoice by printer", "invoice print"
    ], //14


    //Customer
    ["how can i add new customer", "customer function", "function customer", "how to add customer", "how to add new customer", "add customer", "add new customer",
        "i want to add new customer", "i want to add customer", "customer", "customer list", "list of customer", "customer"
    ], //1
    ["how can i edit customer", "how to edit customer", "edit customer", "customer edit", "i want to edit customer"], //2
    ["how can i delete customer", "how to delete customer", "delete customer", "customer delete", "i want to delete customer"], //3
    ["customer exist", "existed customer", "customer already exist"], //4


    //Supplier
    ["how can i add new supplier", "supplier function", "function supplier", "how to add supplier", "how to add new supplier", "add supplier", "add new supplier",
        "i want to add new supplier", "i want to add supplier", "supplier", "supplier list", "list of supplier", "supplier"
    ], //1
    ["how can i edit supplier", "how to edit supplier", "edit supplier", "supplier edit", "i want to edit supplier"], //2
    ["how can i delete supplier", "how to delete supplier", "delete supplier", "supplier delete", "i want to delete supplier"], //3
    ["supplier exist", "existed supplier", "supplier already exist"], //4


    //Profile
    ["how can i see my profile", "profile function", "function profile", "how to see profile", "my profile", "show me my profile",
        "i want to see my profile", "show my product", "profile", "how can i see my information", "how to see my information", "my information", "show me my information",
        "i want to see my information", "show my information", "personal information"
    ], //1
    ["how to edit profile", "edit profile", "profile edit", "i want to edit my profile", "how to edit my information",
        "how to edit information", "edit personal information", "personal information edit", "i want to edit my profile"
    ], //2
    ["how can i update my avatar", "avatar update", "update avatar", "how to update avatar", "i want to update my avatar",
        "how can i edit my avatar", "avatar edit", "edit avatar", "how to edit avatar", "i want to edit my avatar",
    ], //3
    ["how to edit password", "edit password", "password edit", "i want to edit my password", "how to edit my password", "set new password"], //4
    ["what is remain time", "remain time declaration", "remain time"], //5
    ["what is expire day", "expire day declaration", "expire day"], //6

    //Statistic
    // ["number of product"], //1

    //Log


    //Relevant
    //extent account
    //about


];

// Possible responses corresponding to triggers
//<a href=''></a>
const answers = [
    ["Fine... how are you?", "Pretty well, how are you?", "Fantastic, how are you?"], //0
    ["Hello!", "Hi!", "Hey!", "Hi there!", "Howdy"], //1
    ["Nothing much", "About to go to sleep", "Can you guess?", "I don't know actually"], //2
    ["Just born few months ago"], //3
    ["I am just a bot", "I am a bot, of course"], //4
    ["Glad to hear that", "Good to hear", "I hope so", "Alright then", "Thank you", "Well thanks", "Appreciate it", "Im just trying my best"], //5
    ["I am sorry", "Sorry for the inconvenient", "Sorry for your bad experience", "I will fix it next time, sorry", "I just was born few months ago, still learning"], //6
    ["VNS validate input form with no special character (<, >, ., \", '), image must be in type of(JPEG, PNG, BMP) and the value must be in it right form according to the input type (email, phone)"], //7
    ["Oke see you next time, hope you enjoy VNS", "Hope your questions answered", "Oke have fun"], //tạm biệt


    //Product
    ["VNS validate the add or edit product is must be no duplicate product code, because product code is unit for every product and it using to declare every single product, you can check at it search bar be for add"], //1
    ["You must be add image for every product, each product when create invoice need an image to declare, this error also "], //2
    ["You only can add an image with the condition: <br>- Image width must not larger than image height 2 or more times<br>- Image height must not larger than image width 2.5 or more times"], //3
    ["In <a href='?page=product'>product page</a>, click plus button in the top right of product table, then fill the form with valid information"], //4
    ["In <a href='?page=product'>product page</a>, click the edit icon to open edit product form, then you can edit that filled form to change product information"], //5
    ["In <a href='?page=product'>product page</a>, click the delete icon and confirm to delete product"], //6
    ["We resize it with maximum 512px and store it"], //7
    ["Is the name of product, you should clearly declare product name to avoid confusing with other product"], //8
    ["Is the code of product, product code is unit and important in determine a product, you should clearly declare product code to avoid duplicating and error warning"], //9
    ["Is the name of the product, you can freely add as you want"], //10
    ["Product brand including manufacturer or copyright owner, help shop-owner to classify product according to brand"], //11
    ["Product category including type or function of product, help shop-owner to classify product according to category"], //12
    ["Is the standard price that the product will sale and calculate in invoice"], //13
    ["This field is not contribute to any function of the system yet, but it will help a lot in future"], //14
    ["Just the description of product"], //15


    //Cat Brand
    ["In <a href='?page=cat_brand'>category page</a>, click plus button in the top right of category table, then enter the category name you want to add.<br>But if you create new product with a category name that have not been created before, that category name will be added as the new category and will appear in category table for you to check"], //1
    ["In <a href='?page=cat_brand'>brand page</a>, click plus button in the top right of brand table, then enter the brand name you want to add.<br>But if you create new product with a brand name that have not been created before, that brand name will be added as the new brand and will appear in brand table for you to check"], //2
    ["In <a href='?page=cat_brand'>category page</a>, click the edit icon to open edit category form, then you can edit that selected category name, and of course, this action will also change category name in linked product"], //3
    ["In <a href='?page=cat_brand'>brand page</a>, click the edit icon to open edit brand form, then you can edit that selected brand name, and of course, this action will also change category name in linked product"], //4
    ["In <a href='?page=cat_brand'>category page</a>, click the delete icon and confirm to delete category"], //5
    ["In <a href='?page=cat_brand'>brand page</a>, click the delete icon and confirm to delete brand"], //6
    ["Category name must not duplicated with others, you can check at it search bar before add"], //7
    ["Brand name must not duplicated with others, you can check at it search bar before add"], //8


    //Invoice
    ["- Invoice is a function to create a invoice<br>- Invoice include import invoice and export invoice<br>- Import invoice store product code, product image, product name, quantity, price, total, customer, subtotal, discount percent, paid, dept<br>- Export invoice store product code, product image, product name, quantity, price, total, supplier, subtotal, discount percent, paid, dept"], //1
    ["Import invoice is to store invoice of import bill with supplier name"], //2
    ["Export invoice is to store invoice of export bill with customer name"], //3
    ["To add new invoice, you click Invoice in the side bar and pick the invoice type you need to add, you can also add export invoice in top bar by Create Invoice button"], //4
    ["It is the raw total value of the invoice without tax or discount calculated"], //5
    ["It is the discount percent of the bill"], //6
    ["It is the money that customer paid"], //7
    ["It is the customer paid missing value"], //8 
    ["Just a note"], //9
    ["You need to fill Discount field"], //10
    ["You need to fill Paid field"], //11
    ["The customer payment amount is larger than the total price, and this is invalid"], //12
    ["You miss a value in invoice table or one of the product is sold out"], //13
    ["Just click the print icon in invoice table then you can chose save as PDF or print or other options"], //14


    //Customer
    ["You get to <a href='?page=customer'>customer page</a>, click the plus icon at top right corner of the table list, then fill the form"], //1
    ["You get to <a href='?page=customer'>customer page</a>, click the edit icon of the customer you want to edit"], //2
    ["You get to <a href='?page=customer'>customer page</a>, click the delete icon of the customer you want to edit"], //3
    ["The email you enter is duplicated, that prove this customer have been added in database"], //4


    //Supplier
    ["You get to <a href='?page=supplier'>supplier page</a>, click the plus icon at top right corner of the table list, then fill the form"], //1
    ["You get to <a href='?page=supplier'>supplier page</a>, click the edit icon of the supplier you want to edit"], //2
    ["You get to <a href='?page=supplier'>supplier page</a>, click the delete icon of the supplier you want to edit"], //3
    ["The email you enter is duplicated, that prove this supplier have been added in database"], //4


    //Profile
    ["Click your email or avatar on the top bar then select profile, you will be sent to <a href='?page=profile'>profile page</a>"], //1
    ["Click the edit profile button in <a href='?page=profile'>profile page</a>, then you will be sent to <a href='?page=edit_profile'>edit profile page</a>"], //2
    ["Click the avatar in <a href='?page=edit_profile'>edit profile page</a> and submit your new avatar"], //3
    ["Click change password button in <a href='?page=profile'>profile page</a>, then you will be sent to <a href='?page=change_password'>change password page</a>"], //4
    ["It is the remaining time of your account "], //5
    ["It is the expire day of your account"], //6

    //Statistic
    // [$.ajax({
    //     url: "bot_data.php",
    //     type: "GET",
    //     data: { product_count: 1 },
    //     success: function(res) {
    //         // res = JSON.parse(res)
    //         alert(res)
    //         return res;
    //     }
    // })],


    //Relevant



];

// For any other user input

const alternatives = [
    "Try again",
    "I dont understand",
    "I dont get it",
    "Dont know what is that",
    "Tell me more",
    "Hmm, this is out of my data range, can not answer",
    "Wish i can hear more about that",
    "I dont know what are you talking about",
    "I have no idea",
    "Is that affect to any aspect of your life ?",
    "Can you describe it clearly",
    "I dont have any data for this",
    "Can you give me more detail about that",
    "Keep up with another question, i am still on the training progress",
    "You can write down the error you got while using VNS and i will give you more detail about that"
];