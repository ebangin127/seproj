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
function applyProductId(id) {
  opener.document.forms["newbenchmark"]["productid"].value = id;
  opener.document.getElementById("productid").innerHTML = id;
  self.opener = self;
  window.close();
}