var handleFormWysihtml5 = function() {
    "use strict";
    $("#wysihtml5").wysihtml5()
};
var FormWysihtml5 = function() {
    "use strict";
    return {
        init: function() {
            handleFormWysihtml5()
        }
    }
}()