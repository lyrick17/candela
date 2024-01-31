
const form_address = document.getElementById("form_address_change");
const form_contactnum = document.getElementById("form_contactnum_change");

form_address.addEventListener('submit', function(e) {
    //prevent the page from reloading when form is submitted
    // instead, use fetchapi to send the data and retrieve updates
    e.preventDefault();

    const form = new FormData(this);

    let data = fetch('process_checkout_upd_info.php', {
        method: "POST",
        body: form,
    })
    .then(response => response.json())
    .catch(error => console.log(error));

    let section = document.getElementById("new_info_address");
    let success = document.getElementById("change_address_success");

    if (data.error == 0) {
        section.style.display = "none";
        success.style.display = "block";
    } else {
        alert("Cannot update the address information. Please contact the Candela Team.");
    }
});


form_contactnum.addEventListener('submit', function(e) {
    //prevent the page from reloading when form is submitted
    // instead, use fetchapi to send the data and retrieve updates
    e.preventDefault();

    const form = new FormData(this);


    let data = fetch('process_checkout_upd_info.php', {
        method: "POST",
        body: form,
    })
    .then(response => response.json())
    .catch(error => console.log(error));

    let section = document.getElementById("new_info_contactnumber");
    let success = document.getElementById("change_contactnumber_success");
    console.log(data.error);
    if (data.error == 0) {
        section.style.display = "none";
        success.style.display = "block";
    } else {
        alert("Cannot update the contact number information. Please contact the Candela Team.");
    }
});
