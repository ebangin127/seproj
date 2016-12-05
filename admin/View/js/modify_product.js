function fillForm(data) {
  document.forms["product"]["productid"].value = data["productid"];
  document.forms["product"]["productname"].value = data["productname"];
  document.forms["product"]["price"].value = data["price"];
  document.forms["product"]["imageurl"].value = data["imageurl"];
  document.forms["product"]["description"].value = data["description"];
}