<html>
<head>
<script src="//cdn.bootcss.com/jquery/2.1.2/jquery.min.js"></script>
<script src="/assets/js/integration/jquery.cookie.js"></script>
<script src="/assets/js/productCookie.js"></script>
<script>

addProduct(1, 3, 5);
var products = getProducts();
console.log(products);

addProduct(1, 4, 6);
var products = getProducts();
console.log(products);

clearProducts();
var products = getProducts();
console.log(products);
</script>
</head>
<body>

</body>
</html>
