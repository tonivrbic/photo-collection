document.querySelector("#upload-button").addEventListener("click", function(e) {
  document.querySelector("#fileToUpload").click();
});

document.querySelector("#fileToUpload").addEventListener("change", function(e) {
  document.querySelector("#form").submit();
});

var deleteButton = document.querySelector("#delete-button");
var photosEl = document.querySelectorAll(".photo");
var dialogOverlay = document.querySelector(".dialog__overlay");
var dialogImage, imageLeft, imageTop;

photosEl.forEach(function(el) {
  el.addEventListener("click", function(e) {
    document.body.style.overflow = "hidden";
    dialogImage = document.createElement("img");
    dialogImage.classList.add("dialog__image");
    dialogImage.src = e.target.src;
    dialogImage.width = e.target.width;
    dialogImage.height = e.target.height;
    imageTop = e.target.offsetTop - window.scrollY;
    imageLeft = e.target.offsetLeft - window.scrollX;
    dialogImage.setAttribute(
      "style",
      "top:" + imageTop + "px;left:" + imageLeft + "px;"
    );
    dialogImage.setAttribute("image-id", e.target.getAttribute("image-id"));
    dialogOverlay.setAttribute("style", "display: block;");

    var scale = Math.min(
      window.innerWidth / e.target.width,
      window.innerHeight / e.target.height
    );
    dialogOverlay.parentElement.appendChild(dialogImage);

    setTimeout(function() {
      dialogImage.setAttribute(
        "style",
        "transform:translate(-50%, -50%) scale(" + (scale - 0.25) + ")"
      );
      dialogImage.classList.add("dialog__image--full");
      dialogOverlay.classList.add("dialog__overlay--show");
      deleteButton.classList.add("delete-button--show");
    });

    window.addEventListener("keyup", function(event) {
      if (event.key === "Escape") {
        closeDialog();
      }
    });
  });
});

dialogOverlay.addEventListener("click", function(e) {
  closeDialog();
});

deleteButton.addEventListener("click", function() {
  var id = dialogImage.getAttribute("image-id");

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/delete.php", true);

  //Send the proper header information along with the request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function() {
    //Call a function when the state changes.
    if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
      var photo = document.querySelector(".photo[image-id='" + id + "']");
      photo.parentElement.removeChild(photo);
      closeDialog();
    }
  };
  xhr.send("id=" + id);
});

function closeDialog() {
  dialogImage.setAttribute(
    "style",
    "top:" + imageTop + "px;left:" + imageLeft + "px;"
  );
  dialogImage.classList.remove("dialog__image--full");
  dialogOverlay.classList.remove("dialog__overlay--show");
  deleteButton.classList.remove("delete-button--show");
  setTimeout(function() {
    dialogOverlay.setAttribute("style", "display: none;");
    document.body.style.overflow = "auto";
    dialogOverlay.parentElement.removeChild(dialogImage);
  }, 300);
  window.removeEventListener("keyup");
}
