function addProduct(o,r,c){if($.cookie.json=!0,!(o&&r&&c))throw"Product cookie add failed, information is not integral!";var t=$.cookie("products");t||(t=[]);var i={};i.casaId=o,i.productId=r,i.quantity=c;var d=-1;for(var e in t){var u=t[e];r===u.productId&&(d=e)}d>-1?t[d]=i:t.push(i),$.cookie("products",t,{expires:3,path:"/"})}function getProducts(){return $.cookie.json=!0,$.cookie("products")?$.cookie("products"):[]}function clearProducts(){$.cookie.json=!0,$.removeCookie("products",{path:"/"})}