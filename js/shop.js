$(document).ready(function () {
    //loadContent(colType);
});

function holdUp() {
   
    var type = getUrlVars()["type"];
    //alert('incs/collProducts.php?rnd='+Math.random()*11+"&col="+col+"&line="+line+"&type="+type+"&colid="+ColID);
    $('#prodListDiv').load('/incs/shop.php?rnd=' + Math.random() * 11  + "&type=" + type );
}

function holdUpBack() {
    $('#prodListDiv').load('/incs/feature-products.php');
}

function loadContent(colType)
{
    if (colType == 'mens')
    {
        $('.itemBtn-1').addClass('itemBtnActive');
        $('.itemBtn-1').removeClass('itemBtnInactive');
        $('.itemBtn-1').siblings('.itemBtn').removeClass('itemBtnActive');
        $('.itemBtn-1').siblings('.itemBtn').addClass('itemBtnInactive');
        $('.backBtnWrapper').removeClass('opacityHide');
        $('.backBtnWrapper').addClass('opacityShow');
        $('.copyPanel').fadeOut();

        setTimeout(holdUp, 750);

        $('.selItemBg-1').addClass('selItemBgShow');
        $('.selItemBg-2, .selItemBg-3').removeClass('selItemBgShow');
    }
    else if (colType == 'womens')
    {
        $('.itemBtn-2').addClass('itemBtnActive');
        $('.itemBtn-2').removeClass('itemBtnInactive');
        $('.itemBtn-2').siblings('.itemBtn').removeClass('itemBtnActive');
        $('.itemBtn-2').siblings('.itemBtn').addClass('itemBtnInactive');
        $('.backBtnWrapper').removeClass('opacityHide');
        $('.backBtnWrapper').addClass('opacityShow');
        $('.copyPanel').fadeOut();

        setTimeout(holdUp, 750);

        $('.selItemBg-2').addClass('selItemBgShow');
        $('.selItemBg-1, .selItemBg-3').removeClass('selItemBgShow');
    }
    else if (colType == 'accessories')
    {
        $('.itemBtn-3').addClass('itemBtnActive');
        $('.itemBtn-3').removeClass('itemBtnInactive');
        $('.itemBtn-3').siblings('.itemBtn').removeClass('itemBtnActive');
        $('.itemBtn-3').siblings('.itemBtn').addClass('itemBtnInactive');
        $('.backBtnWrapper').removeClass('opacityHide');
        $('.backBtnWrapper').addClass('opacityShow');
        $('.copyPanel').fadeOut();

        setTimeout(holdUp, 750);

        $('.selItemBg-3').addClass('selItemBgShow');
        $('.selItemBg-1, .selItemBg-2').removeClass('selItemBgShow');
    }

}

window.onpopstate = function (event) {
    var tmpPath = location.href;
    var tmpPathArr = tmpPath.split("type=");
    loadContent(tmpPathArr[1]);
};

//  Clicking any Gender Button
$(document).on('click', '.itemBtn', function () {
    $(this).addClass('itemBtnActive');
    $(this).removeClass('itemBtnInactive');
    $(this).siblings('.itemBtn').removeClass('itemBtnActive');
    $(this).siblings('.itemBtn').addClass('itemBtnInactive');
    $('.backBtnWrapper').removeClass('opacityHide');
    $('.backBtnWrapper').addClass('opacityShow');
    $('.copyPanel').fadeOut();
});

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

//  Clicking a Specific Gender Button
$(document).on('click', '.itemBtn-1', function () {
    setTimeout(holdUp, 750);

    $('.selItemBg-1').addClass('selItemBgShow');
    $('.selItemBg-2, .selItemBg-3').removeClass('selItemBgShow');
    var col = getUrlVars()["col"];
    var line = getUrlVars()["line"];
    history.pushState('', 'Mens', '/shop.php?type=mens');
    //e.preventDefault();
});

$(document).on('click', '.itemBtn-2', function () {
    setTimeout(holdUp, 750);

    $('.selItemBg-2').addClass('selItemBgShow');
    $('.selItemBg-1, .selItemBg-3').removeClass('selItemBgShow');
    var type = getUrlVars()["type"];
    history.pushState('', 'Womens', '/shop.php?type=womens');
    //e.preventDefault();
});

$(document).on('click', '.itemBtn-3', function () {
    setTimeout(holdUp, 750);

    $('.selItemBg-3').addClass('selItemBgShow');
    $('.selItemBg-1, .selItemBg-2').removeClass('selItemBgShow');
    var col = getUrlVars()["col"];
    var line = getUrlVars()["line"];
    history.pushState('', 'Accessories', '/shop.php?type=accessories');
    //e.preventDefault();
});

$(document).on('click', '.itemBtnInactive', function () {
    $(this).siblings('.itemBtn').addClass('itemBtnInactive');
});

//  Clicking the Back Button
$(document).on('click', '.backBtnWrapper', function () {
    $('.copyPanel').fadeOut();
    setTimeout(holdUpBack, 750);

    $('.selItemBg').removeClass('selItemBgShow');
    $('.itemBtn').removeClass('itemBtnActive');
    $('.itemBtn').addClass('itemBtnInactive');
    $('.backBtnWrapper').removeClass('opacityShow');
    $('.backBtnWrapper').addClass('opacityHide');
});