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

  var menuParents = document.querySelectorAll('.site-nav .menu-item-has-children');

  function closeAllSubmenus(exceptItem) {
    menuParents.forEach(function (item) {
      if (exceptItem) {
        var sameItem = item === exceptItem;
        var isAncestor = item.contains(exceptItem);
        var isDescendant = exceptItem.contains(item);

        // Keep the currently toggled branch open (item + its parents/children).
        if (sameItem || isAncestor || isDescendant) {
          return;
        }
      }

      item.classList.remove('is-open');

      var toggle = item.querySelector('.site-nav__toggle');
      if (toggle) {
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  menuParents.forEach(function (item, index) {
    var link = null;
    var submenu = null;

    Array.prototype.forEach.call(item.children, function (child) {
      if (!link && child.tagName === 'A') {
        link = child;
      }

      if (!submenu && child.classList && child.classList.contains('sub-menu')) {
        submenu = child;
      }
    });

    if (!link || !submenu) {
      return;
    }

    if (!submenu.id) {
      submenu.id = 'submenu-' + index;
    }

    var toggle = document.createElement('button');
    toggle.type = 'button';
    toggle.className = 'site-nav__toggle';
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-controls', submenu.id);
    toggle.innerHTML = '<span class="screen-reader-text">Afficher le sous-menu</span><span aria-hidden="true">▾</span>';

    item.insertBefore(toggle, submenu);

    toggle.addEventListener('click', function (event) {
      event.preventDefault();
      event.stopPropagation();

      var isOpen = item.classList.contains('is-open');

      closeAllSubmenus(item);

      if (!isOpen) {
        item.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
      } else {
        item.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  });

  document.addEventListener('click', function (event) {
    var clickedInsideNav = event.target && event.target.closest && event.target.closest('.site-nav');
    if (!clickedInsideNav) {
      closeAllSubmenus();
    }
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeAllSubmenus();
    }
  });
})();
