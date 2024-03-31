

const forms = document.querySelectorAll('form-products');
let message = document.getElementById('change-message');
forms.forEach(form => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const form = new FormData(this);
        let data;
        
        // will pass the product_id, price and stocks
        fetch('admin_update_product_1.php', {
            method: "POST",
            body: form,
        })
        .then(response => response.json())
        .then((responseData) => {
            data = responseData; // Assign the response data to the data variable
            console.log(data);
            if (data.error == 0) {
                document.getElementById('change-message').innerHTML = "Changes saved.";
                document.getElementById('change-message').style.color = "green";
            } else {
                error_message(data.error); // display error message
            }
        })
        .then(() => {
            show_changes(data); // after the process, display whether the process is successful or not
        });

    });
});


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