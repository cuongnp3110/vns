//######################## ADD PRODUCT VALIDATE ########################
function validateProductAdd() {
    const _proName = document.getElementById("product_name").value;
    const _proCode = document.getElementById("product_code").value;
    const _proNPrice = document.getElementById("product_nprice").value;
    const _proDPrice = document.getElementById("product_dprice").value;
    const _proAmount = document.getElementById("amount").value;
    const _proColor = document.getElementById("color").value;
    const _proBrand = document.getElementById("product_brand").value;
    const _proCat = document.getElementById("product_cat").value;
    if (_proName.trim() == "" || _proName.length > 150) {
        document.getElementById("pro_name_status").hidden = false;
        document.getElementById("product_name").style.borderColor = "red";
        document.getElementById("pro_name_status").innerHTML = "Required";
        return false;
    } else if (_proName.indexOf(",") != -1 || _proName.indexOf("'") != -1 || _proName.indexOf('"') != -1 || _proName.indexOf("<") != -1 || _proName.indexOf(">") != -1) {
        document.getElementById("pro_name_status").hidden = false;
        document.getElementById("product_name").style.borderColor = "red";
        document.getElementById("pro_name_status").style.color = "red";
        document.getElementById("pro_name_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_proCode.trim() == "" || _proCode.length > 15) {
        document.getElementById("pro_code_status").hidden = false;
        document.getElementById("product_code").style.borderColor = "red";
        document.getElementById("pro_code_status").innerHTML = "Required";
        return false;
    } else if (_proCode.indexOf(",") != -1 || _proCode.indexOf("'") != -1 || _proCode.indexOf('"') != -1 || _proCode.indexOf("<") != -1 || _proCode.indexOf(">") != -1) {
        document.getElementById("pro_code_status").hidden = false;
        document.getElementById("product_code").style.borderColor = "red";
        document.getElementById("pro_code_status").style.color = "red";
        document.getElementById("pro_code_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_proAmount.trim() == "" || _proAmount < 0) {
        document.getElementById("pro_amount_status").hidden = false;
        document.getElementById("amount").style.borderColor = "red";
        document.getElementById("pro_amount_status").innerHTML = "Required";
        return false;
    } else if (_proColor.indexOf(",") != -1 || _proColor.indexOf("'") != -1 || _proColor.indexOf('"') != -1 || _proColor.indexOf("<") != -1 || _proColor.indexOf(">") != -1) {
        document.getElementById("pro_color_status").hidden = false;
        document.getElementById("color").style.borderColor = "red";
        document.getElementById("pro_color_status").style.color = "red";
        document.getElementById("pro_color_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_proNPrice.trim() == "" || _proNPrice < 0) {
        document.getElementById("pro_nprice_status").hidden = false;
        document.getElementById("product_nprice").style.borderColor = "red";
        document.getElementById("pro_nprice_status").innerHTML = "Required";
        return false;
    } else if (_proDPrice < 0 || _proDPrice > 100) {
        document.getElementById("pro_dprice_status").hidden = false;
        document.getElementById("product_dprice").style.borderColor = "red";
        document.getElementById("pro_dprice_status").innerHTML = "Value must between 0 and 100";
        return false;
    } else if (_proBrand.trim() == "") {
        document.getElementById("pro_brand_status").hidden = false;
        document.getElementById("product_brand").style.borderColor = "red";
        document.getElementById("pro_brand_status").innerHTML = "Required";
        return false;
    } else if (_proBrand.indexOf(",") != -1 || _proBrand.indexOf("'") != -1 || _proBrand.indexOf('"') != -1 || _proBrand.indexOf("<") != -1 || _proBrand.indexOf(">") != -1) {
        document.getElementById("pro_brand_status").hidden = false;
        document.getElementById("product_brand").style.borderColor = "red";
        document.getElementById("pro_brand_status").style.color = "red";
        document.getElementById("pro_brand_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_proCat.trim() == "") {
        document.getElementById("pro_cat_status").hidden = false;
        document.getElementById("product_cat").style.borderColor = "red";
        document.getElementById("pro_cat_status").innerHTML = "Required";
        return false;
    } else if (_proCat.indexOf(",") != -1 || _proCat.indexOf("'") != -1 || _proCat.indexOf('"') != -1 || _proCat.indexOf("<") != -1 || _proCat.indexOf(">") != -1) {
        document.getElementById("pro_cat_status").hidden = false;
        document.getElementById("product_cat").style.borderColor = "red";
        document.getElementById("pro_cat_status").style.color = "red";
        document.getElementById("pro_cat_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else { return true; }
}

function validateProName(val) {
    if (val.trim() == "" || val.length > 150) {
        document.getElementById("pro_name_status").innerHTML = "Required";
        document.getElementById("pro_name_status").style.color = "red";
        document.getElementById("product_name").style.borderColor = "red";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("product_name").style.borderColor = "red";
        document.getElementById("pro_name_status").style.color = "red";
        document.getElementById("pro_name_status").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("pro_name_status").innerHTML = "Valid";
        document.getElementById("product_name").style.borderColor = "";
        document.getElementById("pro_name_status").style.color = "green";
    }
}

function validateProCode(val) {
    if (val.trim() == "" || val.length > 15) {
        document.getElementById("pro_code_status").innerHTML = "Required";
        document.getElementById("pro_code_status").style.color = "red";
        document.getElementById("product_code").style.borderColor = "red";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("product_code").style.borderColor = "red";
        document.getElementById("pro_code_status").style.color = "red";
        document.getElementById("pro_code_status").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("pro_code_status").innerHTML = "Valid";
        document.getElementById("product_code").style.borderColor = "";
        document.getElementById("pro_code_status").style.color = "green";
    }
}

function validateProNPrice(val) {
    if (val == "") {
        document.getElementById("pro_nprice_status").innerHTML = "Required";
        document.getElementById("pro_nprice_status").style.color = "red";
        document.getElementById("product_nprice").style.borderColor = "red";
    } else if (val < 0) {
        document.getElementById("pro_nprice_status").innerHTML = "Value must be larger than 0";
        document.getElementById("pro_nprice_status").style.color = "red";
        document.getElementById("product_nprice").style.borderColor = "red";
    } else {
        document.getElementById("pro_nprice_status").innerHTML = "Valid";
        document.getElementById("product_nprice").style.borderColor = "";
        document.getElementById("pro_nprice_status").style.color = "green";
    }
}

function validateProDPrice(val) {
    if (val < 0 || val > 100) {
        document.getElementById("pro_dprice_status").innerHTML = "Value must between 0 and 100";
        document.getElementById("pro_dprice_status").style.color = "red";
        document.getElementById("product_dprice").style.borderColor = "red";
    } else {
        document.getElementById("pro_dprice_status").innerHTML = "Valid";
        document.getElementById("product_dprice").style.borderColor = "";
        document.getElementById("pro_dprice_status").style.color = "green";
    }
}

function validateProAmount(val) {
    if (val == "") {
        document.getElementById("pro_amount_status").innerHTML = "Required";
        document.getElementById("pro_amount_status").style.color = "red";
        document.getElementById("amount").style.borderColor = "red";
    } else if (val < 0) {
        document.getElementById("pro_amount_status").innerHTML = "Value must be larger than 0";
        document.getElementById("pro_amount_status").style.color = "red";
        document.getElementById("amount").style.borderColor = "red";
    } else {
        document.getElementById("pro_amount_status").innerHTML = "Valid";
        document.getElementById("amount").style.borderColor = "";
        document.getElementById("pro_amount_status").style.color = "green";
    }
}

function validateProColor(val) {
    if (val == "") {
        document.getElementById("color").style.borderColor = "red";
        document.getElementById("pro_color_status").style.color = "red";
        document.getElementById("pro_color_status").innerHTML = "Must Not Contain Special Character";
    } else if (val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("color").style.borderColor = "red";
        document.getElementById("pro_color_status").style.color = "red";
        document.getElementById("pro_color_status").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("pro_color_status").innerHTML = "Valid";
        document.getElementById("color").style.borderColor = "";
        document.getElementById("pro_color_status").style.color = "green";
    }
}

function validateProBrand(val) {
    if (val == "") {
        document.getElementById("pro_brand_status").innerHTML = "Required";
        document.getElementById("pro_brand_status").style.color = "red";
        document.getElementById("product_brand").style.borderColor = "red";
    } else if (val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("pro_brand_status").innerHTML = "Must Not Contain Special Character";
        document.getElementById("pro_brand_status").style.color = "red";
        document.getElementById("product_brand").style.borderColor = "red";
    } else {
        document.getElementById("pro_brand_status").innerHTML = "Valid";
        document.getElementById("product_brand").style.borderColor = "";
        document.getElementById("pro_brand_status").style.color = "green";
    }
}

function validateProCat(val) {
    if (val == "") {
        document.getElementById("pro_cat_status").innerHTML = "Required";
        document.getElementById("pro_cat_status").style.color = "red";
        document.getElementById("product_cat").style.borderColor = "red";
    } else if (val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("product_cat").style.borderColor = "red";
        document.getElementById("pro_cat_status").style.color = "red";
        document.getElementById("pro_cat_status").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("pro_cat_status").innerHTML = "Valid";
        document.getElementById("product_cat").style.borderColor = "";
        document.getElementById("pro_cat_status").style.color = "green";
    }
}
//######################## ADD PRODUCT VALIDATE ########################



//######################## EDIT PRODUCT VALIDATE ########################
function validateProductEdit() {
    const _proName = document.getElementById("product_name_edit").value;
    const _proCode = document.getElementById("product_code_edit").value;
    const _proNPrice = document.getElementById("product_nprice_edit").value;
    const _proDPrice = document.getElementById("product_dprice_edit").value;
    const _proAmount = document.getElementById("product_amount_edit").value;
    const _proColor = document.getElementById("product_color_edit").value;
    const _proBrand = document.getElementById("product_brand_edit").value;
    const _proCat = document.getElementById("product_cat_edit").value;
    if (_proName.trim() == "" || _proName.length > 150) {
        document.getElementById("pro_name_status_edit").hidden = false;
        document.getElementById("product_name_edit").style.borderColor = "red";
        document.getElementById("pro_name_status_edit").innerHTML = "Required";
        return false;
    } else if (_proName.indexOf(",") != -1 || _proName.indexOf("'") != -1 || _proName.indexOf('"') != -1 || _proName.indexOf("<") != -1 || _proName.indexOf(">") != -1) {
        document.getElementById("pro_name_status_edit").hidden = false;
        document.getElementById("product_name_edit").style.borderColor = "red";
        document.getElementById("pro_name_status_edit").style.color = "red";
        document.getElementById("pro_name_status_edit").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_proCode.trim() == "" || _proCode.length > 15) {
        document.getElementById("pro_code_status_edit").hidden = false;
        document.getElementById("product_code_edit").style.borderColor = "red";
        document.getElementById("pro_code_status_edit").innerHTML = "Required";
        return false;
    } else if (_proCode.indexOf(",") != -1 || _proCode.indexOf("'") != -1 || _proCode.indexOf('"') != -1 || _proCode.indexOf("<") != -1 || _proCode.indexOf(">") != -1) {
        document.getElementById("pro_code_status_edit").hidden = false;
        document.getElementById("product_code_edit").style.borderColor = "red";
        document.getElementById("pro_code_status_edit").style.color = "red";
        document.getElementById("pro_code_status_edit").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_proAmount.trim() == "" || _proAmount < 0) {
        document.getElementById("pro_amount_status_edit").hidden = false;
        document.getElementById("product_amount_edit").style.borderColor = "red";
        document.getElementById("pro_amount_status_edit").innerHTML = "Required";
        return false;
    } else if (_proColor.indexOf(",") != -1 || _proColor.indexOf("'") != -1 || _proColor.indexOf('"') != -1 || _proColor.indexOf("<") != -1 || _proColor.indexOf(">") != -1) {
        document.getElementById("product_color_edit").hidden = false;
        document.getElementById("product_code_edit").style.borderColor = "red";
        document.getElementById("pro_color_status").style.color = "red";
        document.getElementById("pro_color_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_proNPrice.trim() == "" || _proNPrice < 0) {
        document.getElementById("pro_nprice_status_edit").hidden = false;
        document.getElementById("product_nprice_edit").style.borderColor = "red";
        document.getElementById("pro_nprice_status").innerHTML = "Required";
        return false;
    } else if (_proDPrice < 0 || _proDPrice > 100) {
        document.getElementById("pro_dprice_status_edit").hidden = false;
        document.getElementById("product_dprice_edit").style.borderColor = "red";
        document.getElementById("pro_dprice_status_edit").innerHTML = "Value must between 0 and 100";
        return false;
    } else if (_proBrand.trim() == "") {
        document.getElementById("pro_brand_status_edit").hidden = false;
        document.getElementById("product_brand_edit").style.borderColor = "red";
        document.getElementById("pro_brand_status_edit").innerHTML = "Required";
        return false;
    } else if (_proBrand.indexOf(",") != -1 || _proBrand.indexOf("'") != -1 || _proBrand.indexOf('"') != -1 || _proBrand.indexOf("<") != -1 || _proBrand.indexOf(">") != -1) {
        document.getElementById("pro_brand_status_edit").hidden = false;
        document.getElementById("product_brand_edit").style.borderColor = "red";
        document.getElementById("pro_brand_status_edit").style.color = "red";
        document.getElementById("pro_brand_status_edit").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_proCat.trim() == "") {
        document.getElementById("pro_cat_status_edit").hidden = false;
        document.getElementById("product_cat_edit").style.borderColor = "red";
        document.getElementById("pro_cat_status_edit").innerHTML = "Required";
        return false;
    } else if (_proCat.indexOf(",") != -1 || _proCat.indexOf("'") != -1 || _proCat.indexOf('"') != -1 || _proCat.indexOf("<") != -1 || _proCat.indexOf(">") != -1) {
        document.getElementById("pro_cat_status_edit").hidden = false;
        document.getElementById("product_cat_edit").style.borderColor = "red";
        document.getElementById("pro_brand_status_edit").style.color = "red";
        document.getElementById("pro_cat_status_edit").innerHTML = "Must Not Contain Special Character";
        return false;
    } else {
        return true;
    }
}

function validateProNameEdit(val) {
    if (val.trim() == "" || val.length > 150) {
        document.getElementById("pro_name_status_edit").innerHTML = "Required";
        document.getElementById("pro_name_status_edit").style.color = "red";
        document.getElementById("product_name_edit").style.borderColor = "red";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("product_name_edit").style.borderColor = "red";
        document.getElementById("pro_name_status_edit").style.color = "red";
        document.getElementById("pro_name_status_edit").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("pro_name_status_edit").innerHTML = "Valid";
        document.getElementById("product_name_edit").style.borderColor = "";
        document.getElementById("pro_name_status_edit").style.color = "green";
    }
}

function validateProCodeEdit(val) {
    if (val.trim() == "" || val.length > 15) {
        document.getElementById("pro_code_status_edit").innerHTML = "Required";
        document.getElementById("pro_code_status_edit").style.color = "red";
        document.getElementById("product_code_edit").style.borderColor = "red";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("product_code_edit").style.borderColor = "red";
        document.getElementById("pro_code_status_edit").style.color = "red";
        document.getElementById("pro_code_status_edit").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("pro_code_status_edit").innerHTML = "Valid";
        document.getElementById("product_code_edit").style.borderColor = "";
        document.getElementById("pro_code_status_edit").style.color = "green";
    }
}

function validateProNPriceEdit(val) {
    if (val == "") {
        document.getElementById("pro_nprice_status_edit").innerHTML = "Required";
        document.getElementById("pro_nprice_status_edit").style.color = "red";
        document.getElementById("product_nprice_edit").style.borderColor = "red";
    } else if (val < 0) {
        document.getElementById("pro_nprice_status_edit").innerHTML = "Value must be larger than 0";
        document.getElementById("pro_nprice_status_edit").style.color = "red";
        document.getElementById("product_nprice_edit").style.borderColor = "red";
    } else {
        document.getElementById("pro_nprice_status_edit").innerHTML = "Valid";
        document.getElementById("product_nprice_edit").style.borderColor = "";
        document.getElementById("pro_nprice_status_edit").style.color = "green";
    }
}

function validateProDPriceEdit(val) {
    if (val < 0 || val > 100) {
        document.getElementById("pro_dprice_status_edit").innerHTML = "Value must be larger than 0 and smaller than 100";
        document.getElementById("pro_dprice_status_edit").style.color = "red";
        document.getElementById("product_dprice_edit").style.borderColor = "red";
    } else {
        document.getElementById("pro_dprice_status_edit").innerHTML = "Valid";
        document.getElementById("product_dprice_edit").style.borderColor = "";
        document.getElementById("pro_dprice_status_edit").style.color = "green";
    }
}

function validateProAmountEdit(val) {
    if (val == "") {
        document.getElementById("pro_amount_status_edit").innerHTML = "Required";
        document.getElementById("pro_amount_status_edit").style.color = "red";
        document.getElementById("amount").style.borderColor = "red";
    } else if (val < 0) {
        document.getElementById("pro_amount_status_edit").innerHTML = "Value must be larger than 0";
        document.getElementById("pro_amount_status_edit").style.color = "red";
        document.getElementById("product_amount_edit").style.borderColor = "red";
    } else {
        document.getElementById("pro_amount_status_edit").innerHTML = "Valid";
        document.getElementById("product_amount_edit").style.borderColor = "";
        document.getElementById("pro_amount_status_edit").style.color = "green";
    }
}

function validateProColorEdit(val) {
    if (val == "") {
        document.getElementById("product_color_edit").style.borderColor = "red";
        document.getElementById("pro_color_status_edit").style.color = "red";
        document.getElementById("pro_color_status_edit").innerHTML = "Must Not Contain Special Character";
    } else if (val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("product_color_edit").style.borderColor = "red";
        document.getElementById("pro_color_status_edit").style.color = "red";
        document.getElementById("pro_color_status_edit").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("pro_color_status_edit").innerHTML = "Valid";
        document.getElementById("product_color_edit").style.borderColor = "";
        document.getElementById("pro_color_status_edit").style.color = "green";
    }
}

function validateProBrandEdit(val) {
    if (val == "") {
        document.getElementById("pro_brand_status_edit").innerHTML = "Required";
        document.getElementById("pro_brand_status_edit").style.color = "red";
        document.getElementById("product_brand_edit").style.borderColor = "red";
    } else if (val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("pro_brand_status_edit").innerHTML = "Must Not Contain Special Character";
        document.getElementById("pro_brand_status_edit").style.color = "red";
        document.getElementById("product_brand_edit").style.borderColor = "red";
    } else {
        document.getElementById("pro_brand_status_edit").innerHTML = "Valid";
        document.getElementById("product_brand_edit").style.borderColor = "";
        document.getElementById("pro_brand_status_edit").style.color = "green";
    }
}

function validateProCatEdit(val) {
    if (val == "") {
        document.getElementById("pro_cat_status_edit").innerHTML = "Required";
        document.getElementById("pro_cat_status_edit").style.color = "red";
        document.getElementById("product_cat_edit").style.borderColor = "red";
    } else if (val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("product_cat_edit").style.borderColor = "red";
        document.getElementById("pro_cat_status_edit").style.color = "red";
        document.getElementById("pro_cat_status_edit").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("pro_cat_status_edit").innerHTML = "Valid";
        document.getElementById("product_cat_edit").style.borderColor = "";
        document.getElementById("pro_cat_status_edit").style.color = "green";
    }
}
//######################## EDIT PRODUCT VALIDATE ########################



//######################## ADD CAT VALIDATE ########################
function validateCatAdd() {
    const _cat = document.getElementById("cat_name").value;
    if (_cat.trim() == "") {
        document.getElementById("cat_status").hidden = false;
        document.getElementById("cat_name").style.borderColor = "red";
        document.getElementById("cat_status").innerHTML = "Required";
        return false;
    } else if (_cat.indexOf(",") != -1 || _cat.indexOf("'") != -1 || _cat.indexOf('"') != -1 || _cat.indexOf("<") != -1 || _cat.indexOf(">") != -1) {
        document.getElementById("cat_status").hidden = false;
        document.getElementById("cat_name").style.borderColor = "red";
        document.getElementById("cat_status").style.color = "red";
        document.getElementById("cat_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else {
        return true;
    }
}

function validateCatNameAdd(val) {
    if (val.trim() == "") {
        document.getElementById("cat_status").style.color = "red";
        document.getElementById("cat_name").style.borderColor = "red";
        document.getElementById("cat_status").innerHTML = "Required";
    } else if (val.indexOf(",") != -1) {
        document.getElementById("cat_name").style.borderColor = "red";
        document.getElementById("cat_status").style.color = "red";
        document.getElementById("cat_status").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("cat_status").style.color = "green";
        document.getElementById("cat_name").style.borderColor = "";
        document.getElementById("cat_status").innerHTML = "Valid";
    }
}
//######################## ADD CAT VALIDATE ########################

//######################## EDIT CAT VALIDATE ########################
function validateCatEdit() {
    const _cat = document.getElementById("cat_name_edit").value;
    if (_cat.trim() == "") {
        document.getElementById("cat_status_edit").hidden = false;
        document.getElementById("cat_name_edit").style.borderColor = "red";
        document.getElementById("cat_status_edit").innerHTML = "Required";
        return false;
    } else if (_cat.indexOf(",") != -1 || _cat.indexOf("'") != -1 || _cat.indexOf('"') != -1 || _cat.indexOf("<") != -1 || _cat.indexOf(">") != -1) {
        document.getElementById("cat_status").hidden = false;
        document.getElementById("cat_name").style.borderColor = "red";
        document.getElementById("cat_status").style.color = "red";
        document.getElementById("cat_status").innerHTML = "Invalid Value";
        return false;
    } else {
        return true;
    }
}

function validateCatNameEdit(val) {
    if (val.trim() == "") {
        document.getElementById("cat_status_edit").style.color = "red";
        document.getElementById("cat_name_edit").style.borderColor = "red";
        document.getElementById("cat_status_edit").innerHTML = "Required";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("cat_name_edit").style.borderColor = "red";
        document.getElementById("cat_status_edit").style.color = "red";
        document.getElementById("cat_status_edit").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("cat_status_edit").style.color = "green";
        document.getElementById("cat_name_edit").style.borderColor = "";
        document.getElementById("cat_status_edit").innerHTML = "Valid";
    }
}
//######################## EDIT CAT VALIDATE ########################



//######################## ADD BRAND VALIDATE ########################
function validateBrandAdd() {
    const _brand = document.getElementById("brand_name").value;
    if (_brand.trim() == "") {
        document.getElementById("brand_status").hidden = false;
        document.getElementById("brand_name").style.borderColor = "red";
        document.getElementById("brand_status").innerHTML = "Required";
        return false;
    } else if (_brand.indexOf(",") != -1 || _brand.indexOf("'") != -1 || _brand.indexOf('"') != -1 || _brand.indexOf("<") != -1 || _brand.indexOf(">") != -1) {
        document.getElementById("brand_status").hidden = false;
        document.getElementById("brand_name").style.borderColor = "red";
        document.getElementById("brand_status").style.color = "red";
        document.getElementById("brand_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else {
        return true;
    }
}

function validateBrandNameAdd(val) {
    if (val.trim() == "") {
        document.getElementById("brand_status").style.color = "red";
        document.getElementById("brand_name").style.borderColor = "red";
        document.getElementById("brand_status").innerHTML = "Required";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("brand_name").style.borderColor = "red";
        document.getElementById("brand_status").style.color = "red";
        document.getElementById("brand_status").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("brand_status").style.color = "green";
        document.getElementById("brand_name").style.borderColor = "";
        document.getElementById("brand_status").innerHTML = "Valid";
    }
}
//######################## ADD BRAND VALIDATE ########################

//######################## EDIT BRAND VALIDATE ########################
function validateBrandEdit() {
    const _brand = document.getElementById("brand_name_edit").value;
    if (_brand.trim() == "") {
        document.getElementById("brand_status_edit").hidden = false;
        document.getElementById("brand_name_edit").style.borderColor = "red";
        document.getElementById("brand_status_edit").innerHTML = "Required";
        return false;
    } else if (_brand.indexOf(",") != -1 || _brand.indexOf("'") != -1 || _brand.indexOf('"') != -1 || _brand.indexOf("<") != -1 || _brand.indexOf(">") != -1) {
        document.getElementById("brand_status_edit").hidden = false;
        document.getElementById("brand_name_edit").style.borderColor = "red";
        document.getElementById("brand_status_edit").style.color = "red";
        document.getElementById("brand_status_edit").innerHTML = "Must Not Contain Special Character";
        return false;
    } else {
        return true;
    }
}

function validateBrandNameEdit(val) {
    if (val.trim() == "") {
        document.getElementById("brand_status_edit").style.color = "red";
        document.getElementById("brand_name_edit").style.borderColor = "red";
        document.getElementById("brand_status_edit").innerHTML = "Required";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("brand_name_edit").style.borderColor = "red";
        document.getElementById("brand_status_edit").style.color = "red";
        document.getElementById("brand_status_edit").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("brand_status_edit").style.color = "green";
        document.getElementById("brand_name_edit").style.borderColor = "";
        document.getElementById("brand_status_edit").innerHTML = "Valid";
    }
}
//######################## EDIT BRAND VALIDATE ########################



//######################## ADD CUSTOMER VALIDATE ########################
function validateCustomerAdd() {
    const _cusName = document.getElementById("cus_name").value;
    const _cusPhone = document.getElementById("cus_phone").value;
    const _cusEmail = document.getElementById("cus_email").value;
    const _cusPurchased = document.getElementById("cus_purchased").value;
    const _cusDept = document.getElementById("cus_debt").value;
    if (_cusName.trim() == "") {
        document.getElementById("cus_name_status").hidden = false;
        document.getElementById("cus_name").style.borderColor = "red";
        document.getElementById("cus_name_status").innerHTML = "Required";
        return false;
    } else if (_cusName.indexOf(",") != -1 || _cusName.indexOf("'") != -1 || _cusName.indexOf('"') != -1 || _cusName.indexOf("<") != -1 || _cusName.indexOf(">") != -1) {
        document.getElementById("cus_name_status").hidden = false;
        document.getElementById("cus_name").style.borderColor = "red";
        document.getElementById("cus_name_status").style.color = "red";
        document.getElementById("cus_name_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_cusPhone.trim() == "") {
        document.getElementById("cus_phone_status").hidden = false;
        document.getElementById("cus_phone").style.borderColor = "red";
        document.getElementById("cus_phone_status").innerHTML = "Required";
        return false;
    } else if (!_cusPhone.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
        document.getElementById("cus_phone_status").hidden = false;
        document.getElementById("cus_phone").style.borderColor = "red";
        document.getElementById("cus_phone_status").innerHTML = "Invalid Phone Number";
        return false;
    } else if (_cusEmail != "" && !_cusEmail.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("cus_email_status").hidden = false;
        document.getElementById("cus_email").style.borderColor = "red";
        document.getElementById("cus_email_status").innerHTML = "Invalid Email";
        return false;
    } else if (_cusPurchased == "") {
        document.getElementById("cus_purchased_status").hidden = false;
        document.getElementById("cus_purchased").style.borderColor = "red";
        document.getElementById("cus_purchased_status").innerHTML = "Required";
        return false;
    } else if (_cusDept == "") {
        document.getElementById("cus_debt_status").hidden = false;
        document.getElementById("cus_debt").style.borderColor = "red";
        document.getElementById("cus_debt_status").innerHTML = "Required";
        return false;
    } else {
        return true;
    }
}

function validateCusName(val) {
    if (val.trim() == "") {
        document.getElementById("cus_name_status").style.color = "red";
        document.getElementById("cus_name").style.borderColor = "red";
        document.getElementById("cus_name_status").innerHTML = "Required";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("cus_name").style.borderColor = "red";
        document.getElementById("cus_name_status").style.color = "red";
        document.getElementById("cus_name_status").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("cus_name_status").style.color = "green";
        document.getElementById("cus_name").style.borderColor = "";
        document.getElementById("cus_name_status").innerHTML = "Valid";
    }
}

function validateCusPhone(val) {
    if (val.trim() == "") {
        document.getElementById("cus_phone_status").style.color = "red";
        document.getElementById("cus_phone").style.borderColor = "red";
        document.getElementById("cus_phone_status").innerHTML = "Required";
    } else if (!val.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
        document.getElementById("cus_phone_status").style.color = "red";
        document.getElementById("cus_phone").style.borderColor = "red";
        document.getElementById("cus_phone_status").innerHTML = "Invalid Phone Number";
    } else {
        document.getElementById("cus_phone_status").style.color = "green";
        document.getElementById("cus_phone").style.borderColor = "";
        document.getElementById("cus_phone_status").innerHTML = "Valid";
    }
}

function validateCusEmail(val) {
    if (val != "" && !val.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("cus_email_status").style.color = "red";
        document.getElementById("cus_email").style.borderColor = "red";
        document.getElementById("cus_email_status").innerHTML = "Invalid Email";
    } else {
        document.getElementById("cus_email_status").style.color = "green";
        document.getElementById("cus_email").style.borderColor = "";
        document.getElementById("cus_email_status").innerHTML = "Valid";
    }
}

function validateCusPurchased(val) {
    if (val.trim() == "") {
        document.getElementById("cus_purchased_status").style.color = "red";
        document.getElementById("cus_purchased").style.borderColor = "red";
        document.getElementById("cus_purchased_status").innerHTML = "Required";
    } else {
        document.getElementById("cus_purchased_status").style.color = "green";
        document.getElementById("cus_purchased").style.borderColor = "";
        document.getElementById("cus_purchased_status").innerHTML = "Valid";
    }
}

function validateCusDept(val) {
    if (val.trim() == "") {
        document.getElementById("cus_debt_status").style.color = "red";
        document.getElementById("cus_debt").style.borderColor = "red";
        document.getElementById("cus_debt_status").innerHTML = "Required";
    } else {
        document.getElementById("cus_debt_status").style.color = "green";
        document.getElementById("cus_debt").style.borderColor = "";
        document.getElementById("cus_debt_status").innerHTML = "Valid";
    }
}
//######################## ADD CUSTOMER VALIDATE ########################



//######################## EDIT CUSTOMER VALIDATE ########################
function validateCustomerEdit() {
    const _cusNameEdit = document.getElementById("cus_name_edit").value;
    const _cusPhoneEdit = document.getElementById("cus_phone_edit").value;
    const _cusEmailEdit = document.getElementById("cus_email_edit").value;
    const _cusPurchasedEdit = document.getElementById("cus_purchased_edit").value;
    const _cusDeptEdit = document.getElementById("cus_debt_edit").value;
    if (_cusNameEdit.trim() == "") {
        document.getElementById("cus_name_status_edit").hidden = false;
        document.getElementById("cus_name_edit").style.borderColor = "red";
        document.getElementById("cus_name_status_edit").innerHTML = "Required";
        return false;
    } else if (_cusNameEdit.indexOf(",") != -1 || _cusNameEdit.indexOf("'") != -1 || _cusNameEdit.indexOf('"') != -1 || _cusNameEdit.indexOf("<") != -1 || _cusNameEdit.indexOf(">") != -1) {
        document.getElementById("cus_name_status_edit").hidden = false;
        document.getElementById("cus_name_edit").style.borderColor = "red";
        document.getElementById("cus_name_status_edit").style.color = "red";
        document.getElementById("cus_name_status_edit").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_cusPhoneEdit.trim() == "") {
        document.getElementById("cus_phone_status_edit").hidden = false;
        document.getElementById("cus_phone_edit").style.borderColor = "red";
        document.getElementById("cus_phone_status_edit").innerHTML = "Required";
        return false;
    } else if (!_cusPhoneEdit.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
        document.getElementById("cus_phone_status_edit").hidden = false;
        document.getElementById("cus_phone_edit").style.borderColor = "red";
        document.getElementById("cus_phone_status_edit").innerHTML = "Invalid Phone Number";
        return false;
    } else if (_cusEmailEdit != "" && !_cusEmailEdit.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("cus_email_status_edit").hidden = false;
        document.getElementById("cus_email_edit").style.borderColor = "red";
        document.getElementById("cus_email_status_edit").innerHTML = "Invalid Email";
        return false;
    } else if (_cusPurchasedEdit == "") {
        document.getElementById("cus_purchased_status_edit").hidden = false;
        document.getElementById("cus_purchased_edit").style.borderColor = "red";
        document.getElementById("cus_purchased_status_edit").innerHTML = "Required";
        return false;
    } else if (_cusDeptEdit == "") {
        document.getElementById("cus_debt_status_edit").hidden = false;
        document.getElementById("cus_debt_edit").style.borderColor = "red";
        document.getElementById("cus_debt_status_edit").innerHTML = "Required";
        return false;
    } else {
        return true;
    }
}

function validateCusNameEdit(val) {
    if (val.trim() == "") {
        document.getElementById("cus_name_status_edit").style.color = "red";
        document.getElementById("cus_name_edit").style.borderColor = "red";
        document.getElementById("cus_name_status_edit").innerHTML = "Required";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("cus_name_edit").style.borderColor = "red";
        document.getElementById("cus_name_status_edit").style.color = "red";
        document.getElementById("cus_name_status_edit").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("cus_name_status_edit").style.color = "green";
        document.getElementById("cus_name_edit").style.borderColor = "";
        document.getElementById("cus_name_status_edit").innerHTML = "Valid";
    }
}

function validateCusPhoneEdit(val) {
    if (val.trim() == "") {
        document.getElementById("cus_phone_status_edit").style.color = "red";
        document.getElementById("cus_phone_edit").style.borderColor = "red";
        document.getElementById("cus_phone_status_edit").innerHTML = "Required";
    } else if (!val.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
        document.getElementById("cus_phone_status_edit").style.color = "red";
        document.getElementById("cus_phone_edit").style.borderColor = "red";
        document.getElementById("cus_phone_status_edit").innerHTML = "Invalid Phone Number";
    } else {
        document.getElementById("cus_phone_status_edit").style.color = "green";
        document.getElementById("cus_phone_edit").style.borderColor = "";
        document.getElementById("cus_phone_status_edit").innerHTML = "Valid";
    }
}

function validateCusEmailEdit(val) {
    if (val != "" && !val.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("cus_email_status_edit").style.color = "red";
        document.getElementById("cus_email_edit").style.borderColor = "red";
        document.getElementById("cus_email_status_edit").innerHTML = "Invalid Email";
    } else {
        document.getElementById("cus_email_status_edit").style.color = "green";
        document.getElementById("cus_email_edit").style.borderColor = "";
        document.getElementById("cus_email_status_edit").innerHTML = "Valid";
    }
}

function validateCusPurchasedEdit(val) {
    if (val.trim() == "") {
        document.getElementById("cus_purchased_status_edit").style.color = "red";
        document.getElementById("cus_purchased_edit").style.borderColor = "red";
        document.getElementById("cus_purchased_status_edit").innerHTML = "Required";
    } else {
        document.getElementById("cus_purchased_status_edit").style.color = "green";
        document.getElementById("cus_purchased_edit").style.borderColor = "";
        document.getElementById("cus_purchased_status_edit").innerHTML = "Valid";
    }
}

function validateCusDeptEdit(val) {
    if (val.trim() == "") {
        document.getElementById("cus_debt_status_edit").style.color = "red";
        document.getElementById("cus_debt_edit").style.borderColor = "red";
        document.getElementById("cus_debt_status_edit").innerHTML = "Required";
    } else {
        document.getElementById("cus_debt_status_edit").style.color = "green";
        document.getElementById("cus_debt_edit").style.borderColor = "";
        document.getElementById("cus_debt_status_edit").innerHTML = "Valid";
    }
}
//######################## EDIT CUSTOMER VALIDATE ########################



//######################## ADD SUPPLIER VALIDATE ########################
function validateSupplierAdd() {
    const _supName = document.getElementById("sup_name").value;
    const _supPhone = document.getElementById("sup_phone").value;
    const _supEmail = document.getElementById("sup_email").value;
    const _supPurchased = document.getElementById("sup_purchased").value;
    const _supDept = document.getElementById("sup_debt").value;
    if (_supName.trim() == "") {
        document.getElementById("sup_name_status").hidden = false;
        document.getElementById("sup_name").style.borderColor = "red";
        document.getElementById("sup_name_status").innerHTML = "Required";
        return false;
    } else if (_supName.indexOf(",") != -1 || _supName.indexOf("'") != -1 || _supName.indexOf('"') != -1 || _supName.indexOf("<") != -1 || _supName.indexOf(">") != -1) {
        document.getElementById("sup_name_status").hidden = false;
        document.getElementById("sup_name").style.borderColor = "red";
        document.getElementById("sup_name_status").style.color = "red";
        document.getElementById("sup_name_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_supPhone.trim() == "") {
        document.getElementById("sup_phone_status").hidden = false;
        document.getElementById("sup_phone").style.borderColor = "red";
        document.getElementById("sup_phone_status").innerHTML = "Required";
        return false;
    } else if (!_supPhone.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
        document.getElementById("sup_phone_status").hidden = false;
        document.getElementById("sup_phone").style.borderColor = "red";
        document.getElementById("sup_phone_status").innerHTML = "Invalid Phone Number";
        return false;
    } else if (_supEmail != "" && !_supEmail.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("sup_email_status").hidden = false;
        document.getElementById("sup_email").style.borderColor = "red";
        document.getElementById("sup_email_status").innerHTML = "Invalid Email";
        return false;
    } else if (_supPurchased == "") {
        document.getElementById("sup_purchased_status").hidden = false;
        document.getElementById("sup_purchased").style.borderColor = "red";
        document.getElementById("sup_purchased_status").innerHTML = "Required";
        return false;
    } else if (_supDept == "") {
        document.getElementById("sup_debt_status").hidden = false;
        document.getElementById("sup_debt").style.borderColor = "red";
        document.getElementById("sup_debt_status").innerHTML = "Required";
        return false;
    } else {
        return true;
    }
}

function validateSupName(val) {
    if (val.trim() == "") {
        document.getElementById("sup_name_status").style.color = "red";
        document.getElementById("sup_name").style.borderColor = "red";
        document.getElementById("sup_name_status").innerHTML = "Required";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("sup_name").style.borderColor = "red";
        document.getElementById("sup_name_status").style.color = "red";
        document.getElementById("sup_name_status").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("sup_name_status").style.color = "green";
        document.getElementById("sup_name").style.borderColor = "";
        document.getElementById("sup_name_status").innerHTML = "Valid";
    }
}

function validateSupPhone(val) {
    if (val.trim() == "") {
        document.getElementById("sup_phone_status").style.color = "red";
        document.getElementById("sup_phone").style.borderColor = "red";
        document.getElementById("sup_phone_status").innerHTML = "Required";
    } else if (!val.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
        document.getElementById("sup_phone_status").style.color = "red";
        document.getElementById("sup_phone").style.borderColor = "red";
        document.getElementById("sup_phone_status").innerHTML = "Invalid Phone Number";
    } else {
        document.getElementById("sup_phone_status").style.color = "green";
        document.getElementById("sup_phone").style.borderColor = "";
        document.getElementById("sup_phone_status").innerHTML = "Valid";
    }
}

function validateSupEmail(val) {
    if (val != "" && !val.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("sup_email_status").style.color = "red";
        document.getElementById("sup_email").style.borderColor = "red";
        document.getElementById("sup_email_status").innerHTML = "Invalid Email";
    } else {
        document.getElementById("sup_email_status").style.color = "green";
        document.getElementById("sup_email").style.borderColor = "";
        document.getElementById("sup_email_status").innerHTML = "Valid";
    }
}

function validateSupPurchased(val) {
    if (val.trim() == "") {
        document.getElementById("sup_purchased_status").style.color = "red";
        document.getElementById("sup_purchased").style.borderColor = "red";
        document.getElementById("sup_purchased_status").innerHTML = "Required";
    } else {
        document.getElementById("sup_purchased_status").style.color = "green";
        document.getElementById("sup_purchased").style.borderColor = "";
        document.getElementById("sup_purchased_status").innerHTML = "Valid";
    }
}

function validateSupDept(val) {
    if (val.trim() == "") {
        document.getElementById("sup_debt_status").style.color = "red";
        document.getElementById("sup_debt").style.borderColor = "red";
        document.getElementById("sup_debt_status").innerHTML = "Required";
    } else {
        document.getElementById("sup_debt_status").style.color = "green";
        document.getElementById("sup_debt").style.borderColor = "";
        document.getElementById("sup_debt_status").innerHTML = "Valid";
    }
}
//######################## ADD SUPPLIER VALIDATE ########################



//######################## EDIT SUPPLIER VALIDATE ########################
function validateSupplierEdit() {
    const _supNameEdit = document.getElementById("sup_name_edit").value;
    const _supPhoneEdit = document.getElementById("sup_phone_edit").value;
    const _supEmailEdit = document.getElementById("sup_email_edit").value;
    const _supPurchasedEdit = document.getElementById("sup_purchased_edit").value;
    const _supDeptEdit = document.getElementById("sup_debt_edit").value;
    if (_supNameEdit.trim() == "") {
        document.getElementById("sup_name_status_edit").hidden = false;
        document.getElementById("sup_name_edit").style.borderColor = "red";
        document.getElementById("sup_name_status_edit").innerHTML = "Required";
        return false;
    } else if (_supNameEdit.indexOf(",") != -1 || _supNameEdit.indexOf("'") != -1 || _supNameEdit.indexOf('"') != -1 || _supNameEdit.indexOf("<") != -1 || _supNameEdit.indexOf(">") != -1) {
        document.getElementById("sup_name_status_edit").hidden = false;
        document.getElementById("sup_name_edit").style.borderColor = "red";
        document.getElementById("sup_name_status_edit").style.color = "red";
        document.getElementById("sup_name_status_edit").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_supPhoneEdit.trim() == "") {
        document.getElementById("sup_phone_status_edit").hidden = false;
        document.getElementById("sup_phone_edit").style.borderColor = "red";
        document.getElementById("sup_phone_status_edit").innerHTML = "Required";
        return false;
    } else if (!_supPhoneEdit.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
        document.getElementById("sup_phone_status_edit").hidden = false;
        document.getElementById("sup_phone_edit").style.borderColor = "red";
        document.getElementById("sup_phone_status_edit").innerHTML = "Invalid Phone Number";
        return false;
    } else if (_supEmailEdit != "" && !_supEmailEdit.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("sup_email_status_edit").hidden = false;
        document.getElementById("sup_email_edit").style.borderColor = "red";
        document.getElementById("sup_email_status_edit").innerHTML = "Invalid Email";
        return false;
    } else if (_supPurchasedEdit == "") {
        document.getElementById("sup_purchased_status_edit").hidden = false;
        document.getElementById("sup_purchased_edit").style.borderColor = "red";
        document.getElementById("sup_purchased_status_edit").innerHTML = "Required";
        return false;
    } else if (_supDeptEdit == "") {
        document.getElementById("sup_debt_status_edit").hidden = false;
        document.getElementById("sup_debt_edit").style.borderColor = "red";
        document.getElementById("sup_debt_status_edit").innerHTML = "Required";
        return false;
    } else {
        return true;
    }
}

function validateSupNameEdit(val) {
    if (val.trim() == "") {
        document.getElementById("sup_name_status_edit").style.color = "red";
        document.getElementById("sup_name_edit").style.borderColor = "red";
        document.getElementById("sup_name_status_edit").innerHTML = "Required";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("sup_name_edit").style.borderColor = "red";
        document.getElementById("sup_name_status_edit").style.color = "red";
        document.getElementById("sup_name_status_edit").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("sup_name_status_edit").style.color = "green";
        document.getElementById("sup_name_edit").style.borderColor = "";
        document.getElementById("sup_name_status_edit").innerHTML = "Valid";
    }
}

function validateSupPhoneEdit(val) {
    if (val.trim() == "") {
        document.getElementById("sup_phone_status_edit").style.color = "red";
        document.getElementById("sup_phone_edit").style.borderColor = "red";
        document.getElementById("sup_phone_status_edit").innerHTML = "Required";
    } else if (!val.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
        document.getElementById("sup_phone_status_edit").style.color = "red";
        document.getElementById("sup_phone_edit").style.borderColor = "red";
        document.getElementById("sup_phone_status_edit").innerHTML = "Invalid Phone Number";
    } else {
        document.getElementById("sup_phone_status_edit").style.color = "green";
        document.getElementById("sup_phone_edit").style.borderColor = "";
        document.getElementById("sup_phone_status_edit").innerHTML = "Valid";
    }
}

function validateSupEmailEdit(val) {
    if (val != "" && !val.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("sup_email_status_edit").style.color = "red";
        document.getElementById("sup_email_edit").style.borderColor = "red";
        document.getElementById("sup_email_status_edit").innerHTML = "Invalid Email";
    } else {
        document.getElementById("sup_email_status_edit").style.color = "green";
        document.getElementById("sup_email_edit").style.borderColor = "";
        document.getElementById("sup_email_status_edit").innerHTML = "Valid";
    }
}

function validateSupPurchasedEdit(val) {
    if (val.trim() == "") {
        document.getElementById("sup_purchased_status_edit").style.color = "red";
        document.getElementById("sup_purchased_edit").style.borderColor = "red";
        document.getElementById("sup_purchased_status_edit").innerHTML = "Required";
    } else {
        document.getElementById("sup_purchased_status_edit").style.color = "green";
        document.getElementById("sup_purchased_edit").style.borderColor = "";
        document.getElementById("sup_purchased_status_edit").innerHTML = "Valid";
    }
}

function validateSupDeptEdit(val) {
    if (val.trim() == "") {
        document.getElementById("sup_debt_status_edit").style.color = "red";
        document.getElementById("sup_debt_edit").style.borderColor = "red";
        document.getElementById("sup_debt_status_edit").innerHTML = "Required";
    } else {
        document.getElementById("sup_debt_status_edit").style.color = "green";
        document.getElementById("sup_debt_edit").style.borderColor = "";
        document.getElementById("sup_debt_status_edit").innerHTML = "Valid";
    }
}
//######################## EDIT SUPPLIER VALIDATE ########################



//######################## EDIT PROFILE VALIDATE ########################
function validateAccountEdit() {
    const _accountName = document.getElementById("account_name").value;
    const _accountPhone = document.getElementById("account_phone").value;
    const _accountEmail = document.getElementById("account_email").value;
    const _accountAddr = document.getElementById("account_addr").value;
    if (_accountName.trim() == "") {
        document.getElementById("account_name_status").hidden = false;
        document.getElementById("account_name").style.borderColor = "red";
        document.getElementById("account_name_status").innerHTML = "Required";
        return false;
    } else if (_accountName.indexOf(",") != -1 || _accountName.indexOf("'") != -1 || _accountName.indexOf('"') != -1 || _accountName.indexOf("<") != -1 || _accountName.indexOf(">") != -1) {
        document.getElementById("account_name_status").hidden = false;
        document.getElementById("account_name").style.borderColor = "red";
        document.getElementById("account_name_status").style.color = "red";
        document.getElementById("account_name_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_accountEmail.trim() == "") {
        document.getElementById("account_email_status").hidden = false;
        document.getElementById("account_email").style.borderColor = "red";
        document.getElementById("account_email_status").innerHTML = "Required";
        return false;
    } else if (!_accountPhone.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
        document.getElementById("account_phone_status").hidden = false;
        document.getElementById("account_phone").style.borderColor = "red";
        document.getElementById("account_phone_status").innerHTML = "Invalid Phone Number";
        return false;
    } else if (!_accountEmail.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("account_email_status").hidden = false;
        document.getElementById("account_email").style.borderColor = "red";
        document.getElementById("account_email_status").innerHTML = "Invalid Email";
        return false;
    } else if (_accountAddr == "") {
        document.getElementById("account_addr_status").hidden = false;
        document.getElementById("account_addr").style.borderColor = "red";
        document.getElementById("account_addr_status").innerHTML = "Required";
        return false;
    } else {
        return true;
    }
}

function validateAccountName(val) {
    if (val.trim() == "") {
        document.getElementById("account_name_status").style.color = "red";
        document.getElementById("account_name").style.borderColor = "red";
        document.getElementById("account_name_status").innerHTML = "Required";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("account_name").style.borderColor = "red";
        document.getElementById("account_name_status").style.color = "red";
        document.getElementById("account_name_status").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("account_name_status").style.color = "green";
        document.getElementById("account_name").style.borderColor = "";
        document.getElementById("account_name_status").innerHTML = "Valid";
    }
}

function validateAccountEmail(val) {
    if (val.trim() == "") {
        document.getElementById("account_email_status").style.color = "red";
        document.getElementById("account_email").style.borderColor = "red";
        document.getElementById("account_email_status").innerHTML = "Required";
    } else if (!val.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("account_email_status").style.color = "red";
        document.getElementById("account_email").style.borderColor = "red";
        document.getElementById("account_email_status").innerHTML = "Invalid Email";
    } else {
        document.getElementById("account_email_status").style.color = "green";
        document.getElementById("account_email").style.borderColor = "";
        document.getElementById("account_email_status").innerHTML = "Valid";
    }
}

function validateAccountPhone(val) {
    if (val.trim() == "") {
        document.getElementById("account_phone_status").style.color = "red";
        document.getElementById("account_phone").style.borderColor = "red";
        document.getElementById("account_phone_status").innerHTML = "Required";
    } else if (!val.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
        document.getElementById("account_phone_status").hidden = false;
        document.getElementById("account_phone").style.borderColor = "red";
        document.getElementById("account_phone_status").innerHTML = "Invalid Phone Number";
        return false;
    } else {
        document.getElementById("account_phone_status").style.color = "green";
        document.getElementById("account_phone").style.borderColor = "";
        document.getElementById("account_phone_status").innerHTML = "Valid";
    }
}

function validateAccountAddr(val) {
    if (val.trim() == "") {
        document.getElementById("account_addr_status").style.color = "red";
        document.getElementById("account_addr").style.borderColor = "red";
        document.getElementById("account_addr_status").innerHTML = "Required";
    } else {
        document.getElementById("account_addr_status").style.color = "green";
        document.getElementById("account_addr").style.borderColor = "";
        document.getElementById("account_addr_status").innerHTML = "Valid";
    }
}
//######################## EDIT PROFILE VALIDATE ########################



//######################## ADD ACCOUNT VALIDATE ########################
function validateAccAdd() {
    const _accName = document.getElementById("acc_name").value;
    const _accEmail = document.getElementById("acc_email").value;
    if (_accName.trim() == "") {
        document.getElementById("acc_name_status").hidden = false;
        document.getElementById("acc_name").style.borderColor = "red";
        document.getElementById("acc_name_status").innerHTML = "Required";
        return false;
    } else if (_accName.indexOf(",") != -1 || _accName.indexOf("'") != -1 || _accName.indexOf('"') != -1 || _accName.indexOf("<") != -1 || _accName.indexOf(">") != -1) {
        document.getElementById("acc_name_status").hidden = false;
        document.getElementById("acc_name").style.borderColor = "red";
        document.getElementById("acc_name_status").style.color = "red";
        document.getElementById("acc_name_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else if (_accEmail.trim() == "") {
        document.getElementById("acc_email_status").hidden = false;
        document.getElementById("acc_email").style.borderColor = "red";
        document.getElementById("acc_email_status").innerHTML = "Required";
        return false;
    } else if (!_accEmail.trim().match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("acc_email_status").hidden = false;
        document.getElementById("acc_email").style.borderColor = "red";
        document.getElementById("acc_email_status").innerHTML = "Invalid Email";
        return false;
    } else {
        return true;
    };
}

function validateAccName(val) {
    if (val.trim() == "") {
        document.getElementById("acc_name_status").style.color = "red";
        document.getElementById("acc_name").style.borderColor = "red";
        document.getElementById("acc_name_status").innerHTML = "Required";
    } else if (val.indexOf(",") != -1 || val.indexOf("'") != -1 || val.indexOf('"') != -1 || val.indexOf("<") != -1 || val.indexOf(">") != -1) {
        document.getElementById("acc_name").style.borderColor = "red";
        document.getElementById("acc_name_status").style.color = "red";
        document.getElementById("acc_name_status").innerHTML = "Must Not Contain Special Character";
    } else {
        document.getElementById("acc_name_status").style.color = "green";
        document.getElementById("acc_name").style.borderColor = "";
        document.getElementById("acc_name_status").innerHTML = "Valid";
    }
}

function validateAccEmail(val) {
    if (val.trim() == "") {
        document.getElementById("acc_email_status").style.color = "red";
        document.getElementById("acc_email").style.borderColor = "red";
        document.getElementById("acc_email_status").innerHTML = "Required";
    } else if (!val.trim().match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById("acc_email_status").style.color = "red";
        document.getElementById("acc_email").style.borderColor = "red";
        document.getElementById("acc_email_status").innerHTML = "Invalid Email";
    } else {
        document.getElementById("acc_email_status").style.color = "green";
        document.getElementById("acc_email").style.borderColor = "";
        document.getElementById("acc_email_status").innerHTML = "Valid";
    }
}
//######################## ADD ACCOUNT VALIDATE ########################



//######################## ADD ACCOUNT VALIDATE ########################
function invoiceValidate() {
    const _discount = document.getElementById("discount").value;
    const _paid = document.getElementById("paid").value;
    const _total = document.getElementById("total").value;
    if (_discount.trim() == "") {
        document.getElementById("errBoxF").hidden = false;
        document.getElementById("errMessF").innerHTML = "<span class='closeBtn' onclick='errMessF()'>&times;</span><b>Error! </b>Discount Value is Required";
        return false;
    } else if (_discount < 0 || _discount > 100) {
        document.getElementById("errBoxF").hidden = false;
        document.getElementById("errMessF").innerHTML = "<span class='closeBtn' onclick='errMessF()'>&times;</span><b>Error! </b>Discount Percent must between 0 and 100";
        return false;
    } else if (_paid.trim() == "") {
        document.getElementById("errBoxF").hidden = false;
        document.getElementById("errMessF").innerHTML = "<span class='closeBtn' onclick='errMessF()'>&times;</span><b>Error! </b>Paid Value is Required";
        return false;
    } else if (_paid < 0 || _paid > _total) {
        document.getElementById("errBoxF").hidden = false;
        document.getElementById("errMessF").innerHTML = "<span class='closeBtn' onclick='errMessF()'>&times;</span><b>Error! </b>Paid Value is Invalid";
        return false;
    } else {
        return true;
    };
}
//######################## ADD ACCOUNT VALIDATE ########################


function validateLogin() {
    // const _email = document.getElementById("email").value;
    const _pwd = document.getElementById("pwd").value;
    if (_pwd.indexOf(",") != -1 || _pwd.indexOf("'") != -1 || _pwd.indexOf('"') != -1 || _pwd.indexOf("<") != -1 || _pwd.indexOf(">") != -1) {
        document.getElementById("email_status").hidden = false;
        document.getElementById("email").style.borderColor = "red";
        document.getElementById("email_status").innerHTML = "Must Not Contain Special Character";
        return false;
    } else { return true; }
}












// CLOSE POP UP MESSAGE
function errMess() {
    document.getElementById("errBox").hidden = true;
    document.getElementById("errBoxEdit").hidden = true;
    document.getElementById("successBox").hidden = true;
}

function errMessF() {
    document.getElementById("errBoxF").hidden = true;
}

function errMessB() {
    document.getElementById("errBoxB").hidden = true;
    document.getElementById("errBoxEditB").hidden = true;
}
// CLOSE POP UP MESSAGE



// IMAGE SELECTOR ADD PRODUCT
function readURLadd(input) {
    document.getElementById("up_img").hidden = true;
    document.getElementById("img").hidden = false;
    document.getElementById("product_img2").hidden = false;
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#selected_img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$("#product_img").change(function() {
    readURLadd(this);
});
// IMAGE SELECTOR ADD PRODUCT



// IMAGE SELECTOR EDIT PRODUCT
function readURLedit(input) {
    document.getElementById("product_img2_edit").hidden = false;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#selected_img_edit').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#product_img2_edit").change(function() {
    readURLedit(this);
});
// IMAGE SELECTOR EDIT PRODUCT



// IMAGE SELECTOR EDIT PROFILE
function readURLeditProfile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#avt').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#avtInput").change(function() {
    readURLeditProfile(this);
});
// IMAGE SELECTOR EDIT PROFILE



// EDIT CATEGORY GET VALUE
$(document).ready(function() {
    $('.editCat').on('click', function() {
        $('#editCat').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#cat_id_edit').val(data[0]);
        $('#cat_name_edit').val(data[1]);
    });
});
// EDIT CATEGORY GET VALUE



// EDIT BRAND GET VALUE
$(document).ready(function() {
    $('.editBrand').on('click', function() {
        $('#editBrand').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#brand_id_edit').val(data[0]);
        $('#brand_name_edit').val(data[1]);
    });
});
// EDIT BRAND GET VALUE



// EDIT PRODUCT GET VALUE
$(document).ready(function() {
    $('.editProduct').on('click', function() {
        $('#editProduct').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#product_id_edit').val(data[0]);
        $('#product_name_edit').val(data[2]);
        $('#product_code_edit').val(data[1]);
        $('#product_amount_edit').val(data[14]);
        $('#product_color_edit').val(data[12]);
        $('#product_brand_edit').val(data[6]);
        $('#product_cat_edit').val(data[7]);
        $('#product_nprice_edit').val(data[4]);
        $('#product_dprice_edit').val(data[3]);
        $("#selected_img_edit").attr("src", "data/pro_img/" + data[8]);
        $('#product_des_edit').val(data[5]);
    });
});
// EDIT PRODUCT GET VALUE



// EDIT ACCOUNT GET VALUE
$(document).ready(function() {
    $('.editAccountPass').on('click', function() {
        $('#editAccountPass').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#acc_id_ad').val(data[0]);
    });
});
// EDIT ACCOUNT GET VALUE



// EXTENT ACCOUNT GET VALUE
$(document).ready(function() {
    $('.extentTime').on('click', function() {
        $('#extentTime').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#acc_id').val(data[0]);
    });
});
// EXTENT ACCOUNT GET VALUE



// EDIT CUSTOMER GET VALUE
$(document).ready(function() {
    $('.editCustomer').on('click', function() {
        $('#editCustomer').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#cus_id_edit').val(data[0]);
        $('#cus_addr_edit').val(data[1]);
        $('#cus_phone_edit').val(data[2]);
        $('#cus_purchased_edit').val(data[3]);
        $('#cus_debt_edit').val(data[4]);
        $('#cus_des_edit').val(data[5]);
        $('#cus_name_edit').val(data[6]);
        $('#cus_email_edit').val(data[8]);
    });
});
// EDIT CUSTOMER GET VALUE



// EDIT SUPPLIER GET VALUE
$(document).ready(function() {
    $('.editSupplier').on('click', function() {
        $('#editSupplier').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#sup_id_edit').val(data[0]);
        $('#sup_addr_edit').val(data[1]);
        $('#sup_phone_edit').val(data[2]);
        $('#sup_purchased_edit').val(data[3]);
        $('#sup_debt_edit').val(data[4]);
        $('#sup_des_edit').val(data[5]);
        $('#sup_name_edit').val(data[6]);
        $('#sup_email_edit').val(data[8]);
    });
});
// EDIT SUPPLIER GET VALUE



// Delete Product
$(document).ready(function() {
    $('.deleteConfirmProduct').on('click', function() {
        $('#deleteConfirmProduct').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        document.getElementById("deleteMess").innerHTML = data[2];
        $('#delete_id').val(data[0]);
    });
});

// Delete Cat
$(document).ready(function() {
    $('.deleteConfirmCat').on('click', function() {
        $('#deleteConfirmCat').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        document.getElementById("deleteMessCat").innerHTML = data[1];
        $('#delete_id_cat').val(data[0]);
    });
});

// Delete Brand
$(document).ready(function() {
    $('.deleteConfirmBrand').on('click', function() {
        $('#deleteConfirmBrand').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        document.getElementById("deleteMessBrand").innerHTML = data[1];
        $('#delete_id_brand').val(data[0]);
    });
});

// Delete Customer 
$(document).ready(function() {
    $('.deleteConfirmCus').on('click', function() {
        $('#deleteConfirmCus').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        document.getElementById("deleteMessCus").innerHTML = data[6];
        $('#delete_id_cus').val(data[0]);
    });
});

// Delete Supplier 
$(document).ready(function() {
    $('.deleteConfirmSup').on('click', function() {
        $('#deleteConfirmSup').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        document.getElementById("deleteMessSup").innerHTML = data[6];
        $('#delete_id_sup').val(data[0]);
    });
});

// Delete Account 
$(document).ready(function() {
    $('.deleteConfirmAcc').on('click', function() {
        $('#deleteConfirmAcc').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        document.getElementById("deleteMessAcc").innerHTML = data[1];
        $('#delete_id_acc').val(data[0]);
    });
});

// Delete Cat
$(document).ready(function() {
    $('.deleteConfirmInvoice').on('click', function() {
        $('#deleteConfirmInvoice').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        document.getElementById("sup").innerHTML = data[1];
        document.getElementById("price").innerHTML = data[2];
        document.getElementById("date").innerHTML = data[4];
        $('#delete_id_invoice').val(data[0]);
    });
});


// DATA TABLES CUSTOM SCRIPT
$(document).ready(function() {
    $('#dataTable').DataTable();
    $('#dataTableHover').DataTable();
    $('#dataTableHover2').DataTable();
});


function PrintDiv() {
    var divToPrint = document.getElementById('divToPrint');
    var popupWin = window.open('', '_blank', 'width=300,height=300');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    popupWin.document.close();
}