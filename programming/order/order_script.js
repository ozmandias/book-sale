// console.log("order_script");

function add_order() {
    // console.log("add_order");
    window.location.href = "./detail.php?type=order&action=create";
}

function edit_order(id) {
    // console.log("edit_order");
    window.location.href = "./detail.php?type=order&action=edit&id=" + id;
}

function delete_order(id) {
    // console.log("delete_order");
    if(window.confirm("Do you want to delete this order?")) {
        window.location.href = "./order.php?action=delete&id=" + id;
    }
}