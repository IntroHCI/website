$(document).ready(function() {
    initializeSideNav();
    var offset = 60;

    $('#sidenav-content li a').click(function(event) {
        event.preventDefault();
        $($(this).attr('href'))[0].scrollIntoView();
        scrollBy(0, -offset);
    });

});

function initializeSideNav() {
    var selector = '.sidenav #sidenav-content'
    if ($(selector).length == 0) {
        console.log("No element matching selector " + selector + ". Nowhere to put the sidenav content! Returning.");
        return;
    }

    // figure out minimum header value (e.g., h3 is the largest)
    var uniqueHeaderIndices = [];
    $('.sidenav-anchor').each(function() {
        var header = $(this).children(':header').first();
        // http://stackoverflow.com/questions/5127017/automatic-numbering-of-headings-h1-h6-using-jquery
        var hIndex = parseInt(header.prop('nodeName').substring(1));
        if ($.inArray(hIndex, uniqueHeaderIndices) == -1) {
            uniqueHeaderIndices.push(hIndex);
        }
        uniqueHeaderIndices.sort();
    });

    // now put all the <h> elements under each sidenav-anchor into the sidenav
    $('.sidenav-anchor').each(function() {
        var header = $(this).children(':header').first();
        var hrefTarget = $(this).prop('id');
        var levelsDeep = $.inArray(parseInt(header.prop('nodeName').substring(1)), uniqueHeaderIndices);
        console.log(levelsDeep);

        var elem = "";
        for (var i=0; i<levelsDeep; i++) {
            elem += "<ul class='nav'><li>";
        }
        elem += '<a href="#' + hrefTarget + '">' + header.text() + '</a>';
        for (var i=0; i<levelsDeep; i++) {
            elem += "</li></ul>";
        }
        console.log(elem);

        $('#sidenav-content').append('<li>' + elem + '</li>');
    });
}
