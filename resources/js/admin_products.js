

const forms = document.querySelectorAll('form-products');
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
        })
        .then(() => {
            show_changes(data); // after the process, display whether the process is successful or not
        });

    });
});