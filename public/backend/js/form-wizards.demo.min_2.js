var handleBootstrapWizards = function() {
    "use strict";
    $("#wizard").bwizard()
};
var FormWizard = function() {
    "use strict";
    return {
        init: function() {
            handleBootstrapWizards()
        }
    }
}()