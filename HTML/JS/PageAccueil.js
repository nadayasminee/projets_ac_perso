document.querySelector(".show-login").addEventListener("click", function() {
    document.querySelector(".login").classList.add("active");
});

document.querySelector(".login .close-btn").addEventListener("click", function() {
    document.querySelector(".login").classList.remove("active");
});
