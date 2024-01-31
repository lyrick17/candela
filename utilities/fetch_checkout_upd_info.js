
const form_address = document.getElementById("form_address_change");
const form_contactnum = document.getElementById("form_contactnum_change");

form_address.addEventListener('submit', function(e) {
    //prevent the page from reloading when form is submitted
    // instead, use fetchapi to send the data and retrieve updates
    e.preventDefault();

    const form = new FormData(this);

    change_info(form);
});


form_contactnum.addEventListener('submit', function(e) {
    //prevent the page from reloading when form is submitted
    // instead, use fetchapi to send the data and retrieve updates
    e.preventDefault();

    const form = new FormData(this);


    change_info(form);
});


function change_info(form) {
    let data = fetch('process_checkout_upd_info.php', {
                        method: "POST",
                        body: form,
                    })
                    .then(response => response.json())
                    .catch(error => console.log(error));
                    
    let section = document.getElementById("new_info");
    let successMessage = document.getElementById("success_message");
    let errorMessage = document.getElementById("error_message");
    
    if (data.error == 0) {
        section.style.display = "none";
        successMessage.style.display = "block";
    } else {
        alert("Cannot update the information. Please contact the Candela Team.");
    }

}