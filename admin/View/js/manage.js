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