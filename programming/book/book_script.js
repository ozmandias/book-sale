// console.log("book script");

function add_book() {
    // console.log("add_book");
    window.location.href = "./detail.php?type=book&action=create";
}

function edit_book(id) {
    // console.log("edit_book");
    window.location.href = "./detail.php?type=book&action=edit&id=" + id;
}

function delete_book(id) {
    // console.log("delete_book");
    if(window.confirm("Do you want to delete this book?")) {
        window.location.href = "./book.php?action=delete&id=" + id;
    }
}