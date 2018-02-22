var page = require('webpage').create();
var system = require('system');
var args = system.args;

var url = args[1];
if (url == undefined) {
        phantom.exit();
}

page.open(url, function(status) {
            if (status === 'success') {
                var body = page.evaluate(function() {
                   return '<html>' + document.getElementsByTagName('html')[0].innerHTML + '</html>';
               });
                console.log(body);
            }
            phantom.exit();
});
