function printTable(header, data) {
  var headhtml = $("thead");
  headhtml += "<tr>";
  for(index in header) {
    headhtml += "<th>" + header[index] + "</th>";
  }
  headhtml += "</tr>";
  $("thead").append(headhtml);

  var bodyhtml = $("thead");
  for(outerindex in data) {
    bodyhtml += "<tr>";
    for(innerindex in data[outerindex]) {
      bodyhtml += "<td>" + data[outerindex][innerindex] + "</td>";
    }
    bodyhtml += "</tr>";
  }
  $("tbody").append(bodyhtml);
}
function hideIfNotSufficient(type, permittedtype, element) {
  if(permittedtype.indexOf(type) == -1) {
    $("#" + element).hide();
  }
}
function refreshMenu(type) {
  hideIfNotSufficient(type, ["admin"], "manage_accounts");
  hideIfNotSufficient(type, ["seller", "admin"], "manage_order");
  hideIfNotSufficient(type, ["seller", "admin"], "manage_product");
  hideIfNotSufficient(type, ["reviewer", "admin"], "manage_benchmark");
}