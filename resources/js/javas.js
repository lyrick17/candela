

// STICKY HEADER
window.onscroll = function() {scrolling()};

let menu = document.getElementById("header");
let sticky = menu.offsetTop;

function scrolling() {
  if (window.scrollY > sticky) {
    menu.classList.add("sticky");
  } else {
    menu.classList.remove("sticky");
  }
}



// Javascript for Terms and Conditions Modal
// Get the modal
let modal = document.getElementById('myModal');
// Get the button that opens the modal
let btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
let span = document.getElementsByClassName("modal-close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


// Javascript for the Mobile Menu
function handleNavbarExpand() {
  const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

  if (isMobile) {
    // Code to execute if the user is on a mobile device
    document.getElementById("header").classList.remove("show");
    document.getElementById("bottom_header").classList.add("show");
  } else {
    // Code to execute if the user is not on a mobile device
    if (window.innerWidth < 992) {
      document.getElementById("header").classList.remove("show");
      document.getElementById("bottom_header").classList.add("show");
      // Perform actions for specific window size
    } else {
      document.getElementById("header").classList.add("show");
      document.getElementById("bottom_header").classList.remove("show");
    }
  }
}

window.addEventListener("resize", handleNavbarExpand, true);
handleNavbarExpand();


