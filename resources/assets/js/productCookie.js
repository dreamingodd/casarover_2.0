/** If it exists, will replace*/
function addProduct(casaId, productId, quantity) {
    $.cookie.json = true;
    if (casaId && productId && quantity) {
        var products = $.cookie('products');
        if (!products) products = [];
        var product = {};
        product.casaId = casaId;
        product.productId = productId;
        product.quantity = quantity;
        var existedIndex = -1;
        for (var i in products) {
            let p = products[i];
            if (productId === p.productId) {
                existedIndex = i;
            }
        }
        if (existedIndex > -1) {
            products[existedIndex] = product;
        } else {
            products.push(product);
        }
        $.cookie('products', products, { expires: 3, path: '/' });
    } else {
        throw "Product cookie add failed, information is not integral!";
    }
}
function getProducts() {
    $.cookie.json = true;
    return $.cookie('products') ? $.cookie('products') : [];
}
function clearProducts() {
    $.cookie.json = true;
    $.removeCookie('products', { path: '/' });
}
