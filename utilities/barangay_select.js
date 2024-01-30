// Get the PHP value
let phpValue = document.getElementById("barangayvalue").value;

// Get the select element
let selectElement = document.getElementById("barangay");

// Loop through each option
for (let i = 0; i < selectElement.options.length; i++) {
    var option = selectElement.options[i];

    // Check if the option's innerHTML is equal to the PHP value
    if (option.innerHTML == phpValue) {
        // Set the option as selected
        option.selected = true;
        break;
    }
}