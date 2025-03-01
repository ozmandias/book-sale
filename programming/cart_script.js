console.log("cart_script");

function add_to_cart(id) {
    // console.log("id: " + id + " add_to_cart");
    window.location.href = "./cart.php?book_id=" + id;
}