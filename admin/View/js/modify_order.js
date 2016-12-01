function printTable(id, data) {
  var bodyhtml = "";
  for(outerindex in data) {
    bodyhtml += "<tr>";
    for(innerindex in data[outerindex]) {
      bodyhtml += "<td>" + data[outerindex][innerindex] + "</td>";
    }
    bodyhtml += "</tr>";
  }
  $("#" + id).append(bodyhtml);
}
function fillForm(data) {
  document.getElementById("orderid").innerHTML = data["orderid"];
  document.getElementById("state").innerHTML = data["state"];
  document.forms["order"]["orderid"].value = data["orderid"];
  document.forms["order"]["state"].value = data["state"];
  printTable("delivery", data["delivery"]);
  printTable("shipping", data["shipping"]);
  printTable("product", data["product"]);
}