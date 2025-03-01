// console.log("user script");

function add_user() {
    // console.log("add_user");
    window.location.href = "./detail.php?type=user&action=create";
}

function edit_user(id) {
    // console.log("edit_user");
    window.location.href = "./detail.php?type=user&action=edit&id=" + id;
}

function delete_user(id) {
    // console.log("delete_user");
    if(window.confirm("Do you want to delete this user?")) {
        window.location.href = "./user.php?action=delete&id=" + id;
    }
}