var searchButtons = document.querySelectorAll(".find i");

searchButtons.forEach(function(element) {
    console.log(element);
    element.addEventListener("click", openInput);
});

function openInput(event) {
    var input = event.target.nextElementSibling;
    input.classList.toggle("closed");

}