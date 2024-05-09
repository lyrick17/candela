if (document.getElementById("confirm_delete_account").value != null) {
  let modal_deleteaccount = document.getElementById('myModal2');
  let confirm_delete_account = document.getElementById("confirm_delete_account").value;
  
  let span1 = document.getElementsByClassName("close")[1];
  if (confirm_delete_account == "yes") {
    modal_deleteaccount.style.display = "block";
  }
  span1.onclick = function() {
    modal_deleteaccount.style.display = "none";
  }
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal_deleteaccount) {
        modal_deleteaccount.style.display = "none";
      }
    }
}