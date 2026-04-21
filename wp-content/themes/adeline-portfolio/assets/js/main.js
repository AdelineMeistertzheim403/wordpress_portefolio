(function () {
  var cards = document.querySelectorAll('.post-card');

  cards.forEach(function (card, index) {
    card.style.opacity = '0';
    card.style.transform = 'translateY(14px)';

    window.setTimeout(function () {
      card.style.transition = 'opacity 320ms ease, transform 320ms ease';
      card.style.opacity = '1';
      card.style.transform = 'translateY(0)';
    }, 70 * index);
  });
})();
