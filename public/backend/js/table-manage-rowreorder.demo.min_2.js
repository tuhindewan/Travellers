var handleDataTableRowReorder = function() {
        "use strict";
        0 !== $("#data-table").length && $("#data-table").DataTable({
            responsive: !0,
            rowReorder: !0
        })
    },
    TableManageRowReorder = function() {
        "use strict";
        return {
            init: function() {
                handleDataTableRowReorder()
            }
        }
    }();