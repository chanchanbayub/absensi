let boxSign = document.querySelector(".boxsign");
document.body.addEventListener("click", function(e) {
    if(e.target.className == "show-add") {
        e.preventDefault();
        boxSign.classList.add("show-box-sign");
    } else if (e.target.className == "close") {
        e.preventDefault();
        boxSign.classList.remove("show-box-sign");
    }
})