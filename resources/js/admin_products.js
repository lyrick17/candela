

const forms = document.querySelectorAll('form');

forms.forEach(form => {
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
            
            // add a timer to remove the Changes Saved. message
            setTimeout(() => {
                document.getElementById(message_id).innerHTML = "";
                document.getElementById(message_id).style.color = "";
            }, 3000);

        } else {
            error_message(data.error); // display error message
        }
    });

}


function error_message(number) {
    switch (number)  {
        case 1:
            document.getElementById('change-message').innerHTML = "Digits only.";
            document.getElementById('change-message').style.color = "red";
            break;
        case 2:
            document.getElementById('change-message').innerHTML = "Invalid amount.";
            document.getElementById('change-message').style.color = "red";
            break;
        case 3:
            document.getElementById('change-message').innerHTML = "Update Error. Contact Developers.";
            document.getElementById('change-message').style.color = "red";
            break;
        case 4:
            break;
    }
}