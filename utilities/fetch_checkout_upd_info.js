
const form_a = document.getElementById("form_change_address");
const form_c = document.getElementById("form_change_contactnum");

if (form_a) { form_a.addEventListener('submit', perform_changes); }

if (form_c) { form_c.addEventListener('submit', perform_changes); }


function perform_changes(e) {
    e.preventDefault();
    
    const form = new FormData(this);
    let data;

    fetch('success.php', {
        method: "POST",
        body: form,
    })
    .then(response => response.json())
    .then((responseData) => {
        data = responseData; // Assign the response data to the data variable
        console.log(data);
    })
    .then(() => {
        show_changes(data); // after the process, display whether the process is successful or not
    });
}


function show_changes(data) {
    if (data.type == "address") {
        let section = document.getElementById("new_info_address");
        let success = document.getElementById("change_address_success");
        if (data.error != 0) {
            alert("Cannot update the information. Please contact the Candela Team.");
            return;
        }
        section.style.display = "none";
        success.style.display = "block";
    } else if (data.type == "contactnumber") {
        let section = document.getElementById("new_info_contactnumber");
        let success = document.getElementById("change_contactnumber_success");
        if (data.error != 0) {
            alert("Cannot update the information. Please contact the Candela Team.");
            return;
        }
        section.style.display = "none";
        success.style.display = "block";
    }
}