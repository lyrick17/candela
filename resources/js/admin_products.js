

const forms = document.querySelectorAll('form');

forms.forEach(form => {
    if (form.id === 'search-product') {
        return; // ignore the form with id 'search'
    }
    form.addEventListener('submit', update);
});

function update(e) {
    e.preventDefault();

    const form_upd = new FormData(this);
    let data;

    const message_id = "change-message" + form_upd.get('product_id');
    console.log(message_id);
    // will pass the product_id, price and stocks
    fetch('admin-products.php', {
        method: "POST",
        body: form_upd,
    })
    .then(response => response.json())
    .then((responseData) => {
        data = responseData; // Assign the response data to the data variable
        console.log(data);
        if (data.error == 0) {
            document.getElementById(message_id).innerHTML = "Changes saved.";
            document.getElementById(message_id).style.color = "green";
        } else {
            error_message(data.error, message_id); // display error message
        }
        // add a timer to remove the Changes Saved. message
        setTimeout(() => {
            document.getElementById(message_id).innerHTML = "";
            document.getElementById(message_id).style.color = "";
        }, 3000);
    });

}


function error_message(number, message_id) {
    if (number === 1) {
        document.getElementById(message_id).innerHTML = "Digits only.";
        document.getElementById(message_id).style.color = "red";
    } else if (number === 2) {
        document.getElementById(message_id).innerHTML = "Invalid amount.";
        document.getElementById(message_id).style.color = "red";
    } else if (number === 3) {
        document.getElementById(message_id).innerHTML = "Update Error. Contact Developers.";
        document.getElementById(message_id).style.color = "red";
    } else if (number === 4) {
        // do nothing
    }
}