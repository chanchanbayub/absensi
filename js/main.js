let containerModal = document.querySelector(".container-modal");
document.body.addEventListener("click", function(e) {
    if(e.target.className == "add-kegiatan") {  
        e.preventDefault();
        containerModal.classList.add("show-modal");
    } else if (e.target.className == "close-kegiatan") {
        e.preventDefault();
        containerModal.classList.remove("show-modal");
    }
})
let sideMenu = document.querySelector(".sidemenu");
let burger = document.querySelector(".burger");
burger.addEventListener("click", function() {
    sideMenu.classList.toggle("show-menu");
}) 