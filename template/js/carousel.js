  var rightMask = document.getElementById("carousel-right");
  rightMask.addEventListener("click", nextCategory);
  var leftMask = document.getElementById("carousel-left");
  leftMask.addEventListener("click", previousCategory);

function nextCategory(event) {
    var categories = document.querySelector(".carousel ul");
    console.log(categories);
    categories.style.left = "-100%";
    console.log(rightMask);
    rightMask.style.display = "none";
    leftMask.style.display = "flex";
}

  function previousCategory(event) {
      var categories = document.querySelector(".carousel ul");
      console.log(categories);
      categories.style.left = "0";
      leftMask.style.display = "none";
      rightMask.style.display = "flex";
  }