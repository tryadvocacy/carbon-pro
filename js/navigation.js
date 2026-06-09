/**
 * Navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
(function() {
    const container = document.getElementById('carbon-nav');
    if (!container) {
        return;
    }

    const button = document.querySelector('.carbon-menu-toggle');
    if (!button) {
        return;
    }

    const menu = container.querySelector('ul');

    // Hide menu toggle button if menu is empty and return early.
    if (!menu) {
        button.style.display = 'none';
        return;
    }

    button.addEventListener('click', function(event) {
        event.stopPropagation();
        container.classList.toggle('is-open');

        if (container.classList.contains('is-open')) {
            button.setAttribute('aria-expanded', 'true');
        } else {
            button.setAttribute('aria-expanded', 'false');
        }
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInside = container.contains(event.target) || button.contains(event.target);

        if (!isClickInside && container.classList.contains('is-open')) {
            container.classList.remove('is-open');
            button.setAttribute('aria-expanded', 'false');
        }
    });

    // Handle Categories/Tags overflow
    const metaContainers = document.querySelectorAll('.carbon-categories, .carbon-tags');
    metaContainers.forEach(container => {
        if (container.scrollHeight > 100) { // If height exceeds ~3 lines
            container.style.maxHeight = '80px';
            container.style.overflow = 'hidden';
            container.style.position = 'relative';

            const moreBtn = document.createElement('button');
            moreBtn.innerHTML = '<svg focusable="false" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="16" height="16" viewBox="0 0 32 32" aria-hidden="true"><path d="M16 22L6 12 7.4 10.6 16 19.2 24.6 10.6 26 12z"></path></svg>';
            moreBtn.className = 'carbon-meta-more';
            moreBtn.setAttribute('aria-label', 'Show more');
            moreBtn.style.cssText = 'background: #f4f4f4; border: 1px solid #e0e0e0; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 4px; margin-top: 0.5rem;';

            container.after(moreBtn);

            moreBtn.addEventListener('click', function() {
                if (container.style.maxHeight === 'none') {
                    container.style.maxHeight = '80px';
                    moreBtn.style.transform = 'rotate(0deg)';
                    moreBtn.setAttribute('aria-label', 'Show more');
                } else {
                    container.style.maxHeight = 'none';
                    moreBtn.style.transform = 'rotate(180deg)';
                    moreBtn.setAttribute('aria-label', 'Show less');
                }
            });
        }
    });

    // Handle submenu toggling
    const menuItemsWithChildren = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');
    menuItemsWithChildren.forEach(item => {
        item.addEventListener('click', function(e) {
            const href = item.getAttribute('href');
            const parent = item.parentElement;
            
            // On mobile, or if the link is a placeholder, or if it's the first click on desktop
            // we toggle the menu. 
            // In Carbon Design System, Header menus often act as toggles.
            if (href === '#' || href === '' || !parent.classList.contains('is-open')) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close other sibling submenus at the same level
                const siblings = parent.parentElement.children;
                for (let sibling of siblings) {
                    if (sibling !== parent) {
                        sibling.classList.remove('is-open');
                        const siblingLink = sibling.querySelector('a');
                        if (siblingLink) siblingLink.setAttribute('aria-expanded', 'false');
                    }
                }

                const isOpen = parent.classList.toggle('is-open');
                item.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            }
        });
    });

    // Close all submenus when clicking outside
    document.addEventListener('click', function(event) {
        if (!container.contains(event.target)) {
            const openItems = container.querySelectorAll('.is-open');
            openItems.forEach(item => {
                item.classList.remove('is-open');
                const link = item.querySelector('a');
                if (link) link.setAttribute('aria-expanded', 'false');
            });
        }
    });

    // Initialize ARIA attributes
    menuItemsWithChildren.forEach(item => {
        item.setAttribute('aria-haspopup', 'true');
        item.setAttribute('aria-expanded', 'false');
    });

    // Close menu when pressing Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            // First check if a mobile menu is open
            if (container.classList.contains('is-open')) {
                container.classList.remove('is-open');
                button.setAttribute('aria-expanded', 'false');
                button.focus(); // Focus back to the main navigation button
            }
            
            // Also close any expanded submenus
            const openItems = container.querySelectorAll('.is-open');
            openItems.forEach(item => {
                item.classList.remove('is-open');
                const link = item.querySelector('a');
                if (link) {
                    link.setAttribute('aria-expanded', 'false');
                    link.focus(); // Focus back to the link that opened it so we don't lose focus state
                }
            });
        }
    });

    // Toggle .focus class on menu list items when tab-nav enters or leaves
    const menuLinks = container.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('focus', toggleFocus, true);
        link.addEventListener('blur', toggleFocus, true);
    });

    function toggleFocus(event) {
        let self = this;

        // Traverse upwards until we reach the main container
        while (self && self !== container) {
            if (self.tagName.toLowerCase() === 'li') {
                if (event.type === 'focus') {
                    self.classList.add('focus');
                } else if (event.type === 'blur') {
                    self.classList.remove('focus');
                }
            }
            self = self.parentElement;
        }
    }

    // Search form logic
    const searchForms = document.querySelectorAll('.carbon-search-form');
    searchForms.forEach(form => {
        const input = form.querySelector('.search-field');
        const clearBtn = form.querySelector('.search-clear');
        
        if (!input || !clearBtn) return;
        
        input.addEventListener('input', function() {
            clearBtn.style.display = this.value.length > 0 ? 'flex' : 'none';
        });
        
        clearBtn.addEventListener('click', function() {
            input.value = '';
            input.focus();
            this.style.display = 'none';
        });
    });
})();
