function openvalidity() {
  var checkbox = document.getElementById("inp-bool");
  var option = document.getElementById("inp-txt-val");

  if (checkbox.checked) {
    option.style.display = "block";
    option.setAttribute("required", "required");
  } else {
    option.style.display = "none";
    option.removeAttribute("required");
  }

}