// Used to stop images taking time loading when in front of user, instead preload them when website loads.

function preloadImage(url){
    var img=new Image();
    img.src=url;
}