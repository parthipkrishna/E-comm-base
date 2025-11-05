// navbar script start
window.addEventListener("scroll", function () {
  var header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY > 0);
});

// Toggle menu elements
const navMenu = document.getElementById("nav-menu");
const toggleMenu = document.getElementById("toggle-menu");
const closeMenu = document.getElementById("close-menu");
const overlay = document.getElementById("overlay");

// Open menu
toggleMenu.addEventListener("click", () => {
  navMenu.classList.add("show");
  overlay.classList.add("show");
  document.body.classList.add("overflow-hidden");
});

// Close menu function
function closeNav() {
  navMenu.classList.remove("show");
  overlay.classList.remove("show");
  document.body.classList.remove("overflow-hidden");
}

// Close events
closeMenu.addEventListener("click", closeNav);
overlay.addEventListener("click", closeNav);
// navbar script end //////////////////
