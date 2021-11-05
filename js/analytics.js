// Analytics to determine type of user and what user does on website to optimise the flow of website and improve user experience.

// Detect browser being used
// https://code-boxx.com/detect-browser-with-javascript/

// Get Coords of Mouse
// https://www.tutorialspoint.com/javascript-getting-coordinates-of-mouse

// document.body.events capture
// https://developer.mozilla.org/en-US/docs/Web/API/Document/body

// Using cookies for persistant storage [Local Storage / Session Storage]
// https://developer.mozilla.org/en-US/docs/Tools/Storage_Inspector/Local_Storage_Session_Storage

// Google analytics
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-653E971FMT');

// Dont allow google bots to crawl websites.


/**
 * Determine wheter the incognito mode of Google Chrome is available or not.
 */
function isIncognito(callback){
    var fs = window.RequestFileSystem || window.webkitRequestFileSystem;

    if (!fs) {
        callback(false);
    } else {
        fs(window.TEMPORARY,
            100,
            callback.bind(undefined, false),
            callback.bind(undefined, true)
        );
    }
}
isIncognito(function(itIs){
    if(itIs){
        console.log("You are in incognito mode");
    }else{
        console.log("You are NOT in incognito mode");
    }
});


console.log(navigator);
/*
# platform = Win32
# appCodeName = Mozilla
# appName = Netscape
# appVersion = 5.0 (Windows; en-US)
# language = en-US
# mimeTypes = [object MimeTypeArray]
# oscpu = Windows NT 5.1
# vendor = Firefox
# vendorSub = 1.0.7
# product = Gecko
# productSub = 20050915
# plugins = [object PluginArray]
# securityPolicy =
# userAgent = Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7
# cookieEnabled = true
# javaEnabled = function javaEnabled() { [native code] }
# taintEnabled = function taintEnabled() { [native code] }
# preference = function preference() { [native code] }
*/


// https://security.stackexchange.com/questions/56609/js-malware-detection 
// [MAKE EXTENSION TO DETECT JS MALWARE BEFORE BROWSER RENDERS]


// Screen colours
// Screen resolution
// Browser window size

// mobile-detect.js -- https://hgoebl.github.io/mobile-detect.js/ | https://github.com/hgoebl/mobile-detect.js

// Viewport orientation -- https://stackoverflow.com/questions/4917664/detect-viewport-orientation-if-orientation-is-portrait-display-alert-message-ad
if (window.matchMedia("(orientation: portrait)").matches) {console.log("you're in PORTRAIT mode")}
if (window.matchMedia("(orientation: landscape)").matches) {console.log("you're in LANDSCAPE mode");}

// Device orientation - https://developer.mozilla.org/en-US/docs/Web/API/Detecting_device_orientation [experimental]



