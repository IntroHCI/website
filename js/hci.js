$(document).ready(function() {
    initializeSideNav();
});

function initializeSideNav() {
    if ($('.sidenav').length == 0) {
        return;
    }

    // figure out minimum header value (e.g., h3 is the largest)
    var minHeader = Number.MAX_VALUE;
    $('.sidenav-anchor').each(function() {
        var header = $(this).children(':header').first();
        // http://stackoverflow.com/questions/5127017/automatic-numbering-of-headings-h1-h6-using-jquery
        var hIndex = parseInt(header.prop('nodeName').substring(1)) - 1;
        minHeader = Math.min(minHeader, hIndex);
    });

    // now put all the <h> elements under each sidenav-anchor into the sidenav
    $('.sidenav-anchor').each(function() {
        var header = $(this).children(':header').first();
        var hrefTarget = $(this).prop('id');
        var levelsDeep = (parseInt(header.prop('nodeName').substring(1)) - 1) - minHeader;

        var elem = "";
        for (var i=0; i<levelsDeep; i++) {
            elem += "<ul class='nav'><li>";
        }
        elem += '<a href="#' + hrefTarget + '">' + header.text() + '</a>';
        for (var i=0; i<levelsDeep; i++) {
            elem += "</li></ul>";
        }

        $('#navcontent').append('<li>' + elem + '</li>');
    });
}