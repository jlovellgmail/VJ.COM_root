function openModal(mID) {
    $('.modalOverlay').removeClass('hide');
    $('#' + mID).siblings().not('.modalClose').addClass('hide');
    $('#' + mID).removeClass('hide');
}

$(document).on('click', '.modalOverlay, .modalClose, .navBg', function () {
    $('.modalContent').addClass('hide');
    $('.modalOverlay').addClass('hide');
});

$(document).on('click', '.modalWindow', function (e) {
    e.stopPropagation();
});