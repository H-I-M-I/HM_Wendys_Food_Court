function changeBG(tableClass) {
    var rows = document.querySelectorAll(tableClass + " tbody tr");
    var len = rows.length;
    var lastRow = rows[len - 1];
    var lastBG = window
        .getComputedStyle(lastRow)
        .getPropertyValue("background-color");
    for (var i = len - 1; i >= 0; i--) {
        var currentRow = rows[i];
        var prevRow = rows[i - 1];
        var currentBG = window
            .getComputedStyle(currentRow)
            .getPropertyValue("background-color");
        if (prevRow) {
            var prevBG = window
                .getComputedStyle(prevRow)
                .getPropertyValue("background-color");
            currentRow.style.backgroundColor = prevBG;
        } else {
            currentRow.style.backgroundColor = lastBG;
        }
    }
}

var tables = ['.host-table', '.book-table'];
var index = 0;
setInterval(function () {
    changeBG(tables[index]);
    index = (index + 1) % tables.length;
}, 1000);
