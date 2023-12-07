function standardize() {
  var validity = document.getElementById("validade").value;
  var validity_formated = moment(validity).format("YYYY-MM-DD");

}
