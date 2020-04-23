$('[data-preview=preview-font]').on('change', function (elem) {
    let newFont = elem.currentTarget.options[elem.currentTarget.selectedIndex].innerText;
    let re = /\ \([a-z\-]+\)/ig;
    let fontName = re.exec(newFont);
    $('.my-font-preview').css('font-family', newFont.substring(0, fontName.index));
});

