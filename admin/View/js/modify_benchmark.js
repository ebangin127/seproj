function fillForm(data) {
  document.getElementById("productname").innerHTML = data["productname"];
  document.forms["benchmark"]["benchmarkid"].value = data["benchmarkid"];
  document.forms["benchmark"]["imageurl"].value = data["imageurl"];
  document.forms["benchmark"]["maxval"].value = data["maxval"];
  document.forms["benchmark"]["minval"].value = data["minval"];
  document.forms["benchmark"]["avgval"].value = data["avgval"];
  document.forms["benchmark"]["freezingval"].value = data["freezingval"];
}